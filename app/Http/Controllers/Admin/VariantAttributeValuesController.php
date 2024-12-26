<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_product_variant_attribute_values;
use App\Models\tbl_product_variants;
use App\Models\tbl_variant_attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VariantAttributeValuesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the variant attribute values data with related product variant and attribute
            $variantAttributeValues = tbl_product_variant_attribute_values::with(['productVariant', 'variantAttribute'])
                ->select(['id', 'tbl_product_variant_id', 'tbl_variant_attribute_id', 'value', 'updated_at']);

            return datatables()->of($variantAttributeValues)
                ->editColumn('DT_RowIndex', function ($row) {
                    return $row->id;
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('product_variant', function ($row) {

                    // Fetch the product name using a direct DB query
                    $product = DB::table('tbl_products')->where('id', $row->tbl_product_variant_id)->first();
                    return $product->name ?? 'N/A';
                })

                ->addColumn('variant_attribute', function ($row) {
                    return $row->variantAttribute->name ?? 'N/A';
                })

                ->addColumn('action', function ($row) {
                    return '<button type="button" class="btn btn-sm btn-success edit-btn" data-id="' . $row->id . '"><i class="fa fa-edit"></i> </button>';
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.variant-attribute-values.variant-attribute-values-list');
    }


    public function create()
    {
        $variantAttributes = tbl_variant_attributes::all(); // Fetch all variant attributes
        $productVariants = tbl_product_variants::leftJoin('tbl_products', 'tbl_product_variants.tbl_product_id', '=', 'tbl_products.id') // Corrected column name and join condition
            ->select('tbl_product_variants.*', 'tbl_products.name as product_name') // Select product variant data and product name
            ->get(); // Fetch all product variants with the associated product name

        return view('admin.variant-attribute-values.variant-attribute-values-add', compact('variantAttributes', 'productVariants'));
    }



    public function store(Request $request)
    {
        // Validate form input
        $validator = Validator::make($request->all(), [
            'product_variant_id' => 'required|exists:tbl_product_variants,id',
            'variant_attribute_id' => 'required|exists:tbl_variant_attributes,id',
            'value' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if a record with the same product_variant_id and variant_attribute_id already exists
        $existingRecord = tbl_product_variant_attribute_values::where('tbl_product_variant_id', $request->product_variant_id)
            ->where('tbl_variant_attribute_id', $request->variant_attribute_id)
            ->first();

        if ($existingRecord) {
            // If the record exists, redirect back with an error message
            return redirect()->route('variant-attribute-values.create')
                ->with('error', 'Variant Attribute Value already exists for this Product Variant.')
                ->withInput();
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create new Variant Attribute Value
            tbl_product_variant_attribute_values::create([
                'tbl_product_variant_id' => $request->product_variant_id,
                'tbl_variant_attribute_id' => $request->variant_attribute_id,
                'value' => strtolower($request->value),
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect with success message
            return redirect()->route('variant-attribute-values.index')->with('success', 'Variant Attribute Value added successfully!');
        } catch (\Exception $e) {
            // If an error occurs, rollback the transaction
            DB::rollBack();

            // Return an error message if something goes wrong
            return redirect()->route('variant-attribute-values')->with('error', 'Failed to add Variant Attribute Value. ' . $e->getMessage())->withInput();
        }
    }
}
// Failed to add Variant Attribute Value.SQLSTATE[HY000]: General error: 1364 Field 'tbl_product_variant_id' doesn't have a default value (Connection: mysql, SQL: insert into `tbl_product_variant_attribute_values` (`value`, `updated_at`, `created_at`) values (yellow, 2024-12-26 04:23:39, 2024-12-26 04:23:39))