<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavbarController extends Controller
{
    public function index(Request $request)
    {
        $categories = DB::table('tbl_categories')->where('tbl_category_id',null)->where('is_active',1)->select('id','name')->get();
        // Filter by category ID if provided
        if ($request->has('id')) {
            $categories = DB::table('tbl_categories')->where('tbl_category_id',null)->where('is_active',1)->select('id','name')->where('tbl_category_id', $request->id)->get();
        }
        // Return as JSON response
        return response()->json([
            'success' => true,
            'data' => $categories,
        ], 200);
    }
}
