<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('customer.customer-login');
    }

    public function register(){
        return view('customer.customer-register');
    }
}
