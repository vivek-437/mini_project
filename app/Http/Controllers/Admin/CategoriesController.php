<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {

        $categories = tbl_categories::whereNull('tbl_category_id')->with('children')->get();

        // dd($categories);
        if ($request->ajax()) {
        }
        return view('admin.categories.categories-list',compact('categories'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'is_active' => 'nullable|boolean',
        ]);

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

        $order = 1;
        if (!empty($validatedData['tbl_category_id'])) {
            $maxOrder = tbl_categories::where('tbl_category_id', $validatedData['tbl_category_id'])
                ->max('order');

            $order = $maxOrder ? $maxOrder + 1 : 1;
        }

        $category = new tbl_categories();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->tbl_category_id = $validatedData['tbl_category_id'] ?? null;
        $category->image_url = $imagePath;
        $category->is_active = $validatedData['is_active'];
        $category->order = $order;
        $category->save();

        return redirect()->route('categories.list')->with('success', 'Category added successfully.');
    }
}
