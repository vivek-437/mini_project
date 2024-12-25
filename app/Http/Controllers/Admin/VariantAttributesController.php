<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\tbl_variant_attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VariantAttributesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $variantAttribute = tbl_variant_attributes::all();

            return datatables()->of($variantAttribute)->editColumn('updated_at', function ($row) {
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
                })->make(true);
        }
        return view('admin.variant-attributes.variant-attributes-list');
    }

    public function create()
    {
        return view('admin.variant-attributes.variant-attribute-add');
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            // Start a database transaction
            DB::transaction(function () use ($request) {
                tbl_variant_attributes::create([
                    'name' => strtolower($request->name),
                ]);
            });

            // Redirect with a success message
            return redirect()->route('variant-attributes')->with('success', 'Variant Attribute added successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to add Variant attribute. ' . $e->getMessage())->withInput();
        }
    }
}
