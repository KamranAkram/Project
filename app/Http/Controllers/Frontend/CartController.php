<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Models\Cart;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request){
        // $data['carts'] = session()->get('cart');
        $data['products'] = Product::orderBy('id')->with('product_image')->where('status' , 1)->get();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['carts'] = Cart::content();
        // dd($data['carts']);
        return view('frontend.shopping-cart')->with($data);
    }

    public function addToCart(Request $request)
    {
        // $product = Product::findOrFail($request->product_id);


        // $cart = session()->get('cart', []);

        //         if(isset($cart[$id])) {
        //             $cart[$id]['quantity']++;
        //         } else {
        //             $cart[$id]= [
        //                 "title" => $product->title,
        //                 // "slug" => $product->slug,
        //                 "quantity" => $request->qty,
        //                 "price" => $product->price,
        //                 "image" => $product->product_image[0]->image
        //             ];
        //         }

        // session()->put('cart', $cart);
        $product = Product::find($request->id);
        if($product == null){
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ]);
        }

        if(Cart::count() > 0){
            // echo "Product already added in the cart";
            $content = Cart::content();
            $exist = false;

            foreach($content as $item){
                if($item->id == $product->id){
                    $exist = true;
                }
            }
            if($exist == false){
                Cart::add($product->id , $product->title , 1, $product->price, ['productImage' => !empty($product->product_image) ? $product->product_image[0]->image : ''] );
                $status = true;
                $message = $product->title . " added in cart successfully";
            }else{
                $status = false;
                $message = $product->title . " already added in cart";
            }
        }else{
            Cart::add($product->id , $product->title , 1, $product->price, ['productImage' => !empty($product->product_image) ? $product->product_image[0]->image : ''] );
            $status = true;
            $message = $product->title . " added in cart successfully";
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    // Update cart
    public function update(Request $request)
    {
        // if($request->id && $request->quantity){
        //     $cart = session()->get('cart');
        //     $cart[$request->id]["quantity"] = $request->quantity;
        //     session()->put('cart', $cart);
        //     session()->flash('success', 'Cart updated successfully');
        // }
        $rowId = $request->rowId;
        $qty = $request->qty;

        $cartInfo = Cart::get($rowId);
        $product = Product::find($cartInfo->id);

        if($product->track_qty == 'Yes'){
            if($product->qty >= $qty){
                Cart::update($rowId,$qty);
                $message = "Cart Updated Successfully";
                $status = true;
                session()->flash('success' , $message);
            }else{
                $message = 'Requested qty('.$qty.') not available in stock';
                $status = false;
               session()->flash('error' , $message);
            }
        }else{
            Cart::update($rowId,$qty);
            $message = "Cart Updated Successfully";
            $status = true;
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);

    }

    //Delete Cart
    public function remove(Request $request)
    {
        // if($request->id) {
        //     $cart = session()->get('cart');
        //     if(isset($cart[$request->id])) {
        //         unset($cart[$request->id]);
        //         session()->put('cart', $cart);
        //     }
        //     session()->flash('success', 'Product removed successfully');
        // }
        $rowId = $request->rowId;
        $itemInfo = Cart::get($rowId);

        if($itemInfo == null){
            $message = 'Product Not Fond in Cart';

            session()->flash('error' , $message);

            return response()->json([
                'status' => false,
                'message' => $message
            ]);
        }
        Cart::remove($request->rowId);

        $message = 'Product removed from cart successfully';

        session()->flash('success' , $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
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