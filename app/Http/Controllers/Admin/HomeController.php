<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $products = Product::all();
        return view('frontend.index', compact('products'));
    }

    public function dashboard(){
        return view('admin.index');
    }
}