<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request){
        
        if($request->ajax()){
            
        }

        return view('customer.customer-checkout');
    }
}
