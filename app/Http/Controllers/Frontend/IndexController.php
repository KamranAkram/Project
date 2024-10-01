<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        $data['products'] = Product::orderBy('id' , 'DESC')->with('product_image')->where('status' , 1)->get();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        return view('frontend.index')->with($data);
    }
}