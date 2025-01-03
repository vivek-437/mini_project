<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\tbl_product_variants;
use App\Models\tbl_products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
        }
        $products = tbl_products::inRandomOrder()->take(3)->get();

        $banner = tbl_product_variants::with([
            'product',
            'attributes.attribute',
            'images' => function ($query) {
                $query->where('is_primary', true);
            }
        ])->inRandomOrder()->take(3)->get();

        $trandings = tbl_product_variants::with([
            'product',
            'attributes.attribute',
            'images' => function ($query) {
                $query->where('is_primary', true);
            }
        ])->inRandomOrder()->take(20)->get();
        // dd($data);
        return view('customer.customer-home', compact('banner','products','trandings'));
    }
}
