<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_product_variants;
use App\Models\tbl_products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductVariantsController extends Controller
{
    // index file for respective and datatbale calling
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $productVariants = tbl_product_variants::with('product:id,name') // Fetch related product data
                ->select('id', 'tbl_product_id', 'sku', 'price', 'discount_price', 'stock_quantity', 'is_active', 'updated_at');

            return datatables()->of($productVariants)
                ->addColumn('product_name', function ($row) {
                    return optional($row->product)->name ?? 'N/A'; // Graceful handling if product is null
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-success edit-btn mr-2" data-id="' . e($row->id) . '">
                            <i class="fas fa-edit"></i> 
                        </button>
                        <button class="btn btn-sm btn-danger disable-btn" data-id="' . e($row->id) . '">
                            <i class="fas fa-trash"></i> 
                        </button>
                    ';
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active
                        ? '<span class="badge rounded-pill bg-success">Active</span>'
                        : '<span class="badge rounded-pill bg-danger">Inactive</span>';
                })
                ->rawColumns(['action', 'is_active']) // Allows rendering of HTML
                ->make(true);
        }

        return view("admin.product-variants.product-variants-list");
    }



    public function create()
    {
        $products = tbl_products::all("id", "name");
        return view('admin.product-variants.product-variant-add', compact("products"));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validator =  Validator::make($request->all(), [
            'tbl_product_id' => 'required|exists:tbl_products,id',
            'sku' => 'required|string|max:255|unique:tbl_product_variants,sku',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock_quantity' => 'required|integer|min:0',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $imagePath = null;

            DB::transaction(function () use ($request, &$imagePath) {
                // Handle image upload
                if ($request->hasFile('img_url')) {
                    $image = $request->file('img_url');

                    // Fetch the product name and format it
                    $product = tbl_products::findOrFail($request->tbl_product_id);
                    $productName = preg_replace('/\s+/', '_', strtolower($product->name));

                    // Generate the file name
                    $fileName = "{$productName}_" . time() . '.' . $image->getClientOriginalExtension();

                    // Define the public directory path
                    $directory = public_path('product/product_variants');

                    // Ensure the directory exists
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }

                    // Move the image to the directory
                    $image->move($directory, $fileName);

                    // Set the relative image path
                    $imagePath = "product/product_variants/{$fileName}";
                }

                // Create the product variant
                tbl_product_variants::create([
                    'tbl_product_id' => $request->tbl_product_id,
                    'sku' => $request->sku,
                    'price' => $request->price,
                    'discount_price' => $request->discount_price,
                    'stock_quantity' => $request->stock_quantity,
                    'is_active' => $request->boolean('is_active'),
                    'img_url' => $imagePath, // Pass NULL if no image was uploaded
                ]);
            });

            // Redirect with a success message
            return redirect()->route('product-variants')->with('success', 'Product variant added successfully.');
        } catch (\Exception $e) {
            // Handle errors and redirect back with an error message
            return redirect()->back()->with('error', 'Failed to add product variant. ' . $e->getMessage())->withInput();
        }
    }
}
