<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavbarController extends Controller
{
    public function index(Request $request){
        $catergories = DB::table('tbl_categories')->where('tbl_category_id')->get();
    }
}
