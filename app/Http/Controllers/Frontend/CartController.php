<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request){
        $data['carts'] = session()->get('cart');
        $data['products'] = Product::orderBy('id')->with('product_image')->where('status' , 1)->get();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        return view('frontend.shopping-cart')->with($data);
    }

    public function addToCart($id , Request $request)
    {
        $product = Product::findOrFail($request->product_id);


        $cart = session()->get('cart', []);

                if(isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                } else {
                    $cart[$id]= [
                        "title" => $product->title,
                        // "slug" => $product->slug,
                        "quantity" => $request->qty,
                        "price" => $product->price,
                        "image" => $product->product_image[0]->image
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

    // public function delete($id){
    //     $value = Cart::find($id);
    //     // dd($value);
    //     if(!is_null($value)){
    //         $value->delete();
    //     }
    //     return redirect('/cart');
    // }
}