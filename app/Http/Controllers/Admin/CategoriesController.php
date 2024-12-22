<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch categories with their children only for AJAX requests
            $categories = tbl_categories::whereNull('tbl_category_id')
                ->with('children')
                ->get();
    
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('children', function ($row) {
                    // Capitalize first letter of each word in child category names and display them as a comma-separated list
                    $childrenNames = $row->children->pluck('name')->map(function($name) {
                        return ucwords(strtolower($name)); // Capitalize each word in the child category name
                    })->implode(', ');
    
                    return $childrenNames ?: 'No Subcategories';
                })
                ->editColumn('name', function ($row) {
                    return ucwords(strtolower($row->name)); // Capitalize the first letter of each word in the category name
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
                    $editDisabled = !$row->is_active ? 'disabled' : ''; // Disable edit if not active
                    $editTooltip = !$row->is_active ? 'title="Edit Disabled"' : 'title="Edit"'; // Tooltip for edit button
                    $deleteTooltip = 'title="Delete"'; // Tooltip for delete button
    
                    return '<a href="javascript:void(0)" 
                                class="edit btn btn-success btn-sm ' . $editDisabled . '" 
                                data-id="' . $row->id . '" ' . $editTooltip . '>
                                <i class="fas fa-edit"></i> 
                            </a> 
                            <a href="javascript:void(0)" 
                                class="delete btn btn-danger btn-sm" 
                                data-id="' . $row->id . '" ' . $deleteTooltip . '>
                                <i class="fas fa-trash-alt"></i>
                            </a>';
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }
    
        // For non-AJAX requests, just return the view
        return view('admin.categories.categories-list');
    }
    


    public function create()
    {
        $categories = tbl_categories::whereNull('tbl_category_id')->with('children')->get();
        return view('admin.categories.categories-add', compact('categories'));
    }

    public function store(Request $request)
    {
        // Server-side validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => 'required|string|max:255|unique:tbl_categories,slug',
            'tbl_category_id' => 'nullable|exists:tbl_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'is_active' => 'nullable|boolean',
        ]);
    
        // Convert text fields to lowercase
        $name = strtolower($validatedData['name']);
        $description = isset($validatedData['description']) ? strtolower($validatedData['description']) : null;
        $slug = strtolower($validatedData['slug']);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $directory = 'category_images';
            $fullPath = public_path($directory);
    
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }
    
            $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($fullPath, $imageFileName);
            $imagePath = $directory . '/' . $imageFileName;
        }
    
        // Determine order for the category
        $order = 1;
        if (!empty($validatedData['tbl_category_id'])) {
            $maxOrder = tbl_categories::where('tbl_category_id', $validatedData['tbl_category_id'])
                ->max('order');
    
            $order = $maxOrder ? $maxOrder + 1 : 1;
        }
    
        // Create the new category
        $category = new tbl_categories();
        $category->name = $name; // Store name in lowercase
        $category->description = $description; // Store description in lowercase
        $category->slug = $slug; // Store slug in lowercase
        $category->tbl_category_id = $validatedData['tbl_category_id'] ?? null;
        $category->image_url = $imagePath;
        $category->is_active = $validatedData['is_active'];
        $category->order = $order;
        $category->save();
    
        return redirect()->route('categories.list')->with('success', 'Category added successfully.');
    }
    

    public function getChildren(Request $request)
    {
        // Validate the request to ensure parent_id is provided
        $request->validate([
            'parent_id' => 'required|integer|exists:tbl_categories,id',
        ]);

        // Fetch the child categories
        $children = tbl_categories::where('tbl_category_id', $request->parent_id)
            ->select('id', 'name', 'slug', 'description', 'updated_at', 'is_active')
            ->get();

        // Return the response as JSON
        return response()->json($children);
    }
}
