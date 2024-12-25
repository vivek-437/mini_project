<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_categories;
use App\Models\tbl_products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = tbl_products::with('category')->get();  // Assuming 'category' is the relationship method

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('category', function ($row) {
                    // Capitalize first letter of each word in category name
                    return $row->category ? ucwords(strtolower($row->category->name)) : 'No Category';
                })
                ->editColumn('name', function ($row) {
                    // Capitalize first letter of each word in product name
                    return ucwords(strtolower($row->name));
                })
                ->editColumn('is_active', function ($row) {
                    return $row->is_active
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-danger">Inactive</span>';
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-id="' . $row->id . '" title="Edit Product">
                            <i class="fas fa-edit"></i>
                        </a> 
                        <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '" title="Delete Product">
                            <i class="fas fa-trash-alt"></i>
                        </a>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }

        return view('admin.products.products-list');
    }


    public function create()
    {
        $categories = tbl_categories::all();
        return view('admin/products/products-add', compact('categories'));
    }


    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tbl_category_id' => 'required|exists:tbl_categories,id',
            'base_price' => 'required|numeric|regex:/^\d{1,8}(\.\d{1,2})?$/',
            'is_active' => 'nullable|boolean',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Convert base price to decimal with two decimal places
            $basePrice = number_format($request->base_price, 2, '.', ''); // Format to 2 decimal places

            // Convert the product name and description to lowercase
            $name = strtolower($request->name);
            $description = $request->description ? strtolower($request->description) : null;

            // Create the new product record
            $product = tbl_products::create([
                'name' => $name, // Store name in lowercase
                'description' => $description, // Store description in lowercase
                'tbl_category_id' => $request->tbl_category_id,
                'base_price' => $basePrice, // Store as decimal value
                'is_active' => $request->is_active ?? 1,
            ]);

            // Flash a success message to the session
            return redirect()->route('products.list')
                ->with('success', 'Product added successfully.');
        } catch (\Exception $e) {

            // Flash a failure message to the session
            return redirect()->route('products.create')
                ->with('error', 'An error occurred while adding the product. Please try again.' . $e->getMessage())
                ->withInput();
        }
    }
}
