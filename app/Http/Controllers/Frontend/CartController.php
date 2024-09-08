<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view('frontend.shopping-cart');
    }

    public function addToCart($id , Request $request)
    {
        $product = Product::findOrFail($request->product_id);


        $cart = session()->get('cart', []);

                if(isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                } else {
                    $cart[$id]= [
                        "name" => $product->pname,
                        "quantity" => $request->qty,
                        "price" => $product->price,
                        "image" => $product->image
                    ];
                }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Update cart
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    //Delete Cart
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}