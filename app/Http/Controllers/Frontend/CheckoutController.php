<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
// use App\Models\Cart;
use App\Models\Country;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ShopOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Climate\Order;
use Gloudemans\Shoppingcart\Facades\Cart;

// use subtotal;

class CheckoutController extends Controller
{
    public function checkOut(Request $request){
        // $data['carts'] = session()->get('cart');
        // $data['users'] = User::all();

        if(Cart::count() == 0){
            return redirect()->route('cart');
        }

        $data['address'] = Address::where('user_id' , Auth::user()->id)->first();
        $data['countries'] = Country::all();
        $data['products'] = Product::all();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['carts'] = Cart::content();
        return view('frontend.checkout')->with($data);
    }

    public function storeAddress(Request $request){
        //  @dd($request->all());
            // Apply Validation

            $validator = Validator::make($request->all(),[
                    'name'     => 'required|min:5',
                    'email'     => 'required|email',
                    'phone'     => 'required',
                    'country'    => 'required',
                    'address' => 'required|min:30',
                    'zip'          => 'required',
                    'city'          => 'required',
                    'region'        => 'required',
            ]);
            // dd($request->all());

            if($validator->fails()){
                return response()->json([
                    'status' =>false,
                    'message'=> 'Please fix the errors',
                    'errors' => $validator->errors(),
                ]);
            }

            // Store User Address
            $user = Auth::user();


            Address::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'country_id' => $request->country,
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'region' => $request->region,
                    'zip' => $request->zip,
                ]
            );
            // $address = Address::create([
            //     'user_id' => $request->user_id,
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'country_id' => $request->country,
            //     'address' => $request->address,
            //     'apartment' => $request->apartment,
            //     'city' => $request->city,
            //     'region' => $request->region,
            //     'zip' => $request->zip,
            // ]);


            // Store Order Data

            if($request->payment == 'cod'){

                $shipping = 0;
                $subTotal = Cart::subtotal(2, '.' ,'');
                $grandTotal = $subTotal+$shipping;
                // $carts = session()->get('cart');
                // dd($carts);
                $discount = 0;
                $order = new ShopOrder;
                $order->subtotal = $subTotal;
                $order->shipping = $shipping;
                $order->grand_total = $grandTotal;
                $order->user_id = $user->id;
                // Address
                $order->name = $request->name;
                $order->email = $request->email;
                $order->phone = $request->phone;
                $order->country_id = $request->country;
                $order->address = $request->address;
                $order->apartment = $request->apartment;
                $order->city = $request->city;
                $order->region = $request->region;
                $order->zip = $request->zip;
                $order->notes = $request->notes;
                $order->save();


                // Store Order Items in OrderLines Table
                foreach(Cart::content() as $item){
                    $orderItem = new OrderLine;

                    $orderItem->product_id = $item->id;
                    $orderItem->order_id = $order->id;
                    $orderItem->name = $item->name;
                    $orderItem->quantity = $item->qty;
                    $orderItem->price = $item->price;
                    $orderItem->total = $item->qty * $item->price;
                    $orderItem->save();
                    // $orderItem->update($orderItem);
                }

                session()->flash('success' , 'Your order has been successfully placed');
                Cart::destroy();

                return response()->json([
                    'status' => true,
                    'orderId' => $order->id,
                    'message' => 'Order saved Successfully',
                ]);
            }else{

            }


        //     $address = new Address;
        //     // //Insert Query
        //     $address->phone = $request['phone'];
        //     $address->postal_address = $request['postal_address'];
        //     $address->permanent_address = $request['permanent_address'];
        //     $address->city = $request['city'];
        //     $address->region = $request['region'];
        //     $address->postal_code = $request['postal_code'];
        //     $address->country_id = $request['country_id'];
        //     $address->save();

        //     $order = ShopOrder::create([
        //        'user_id' => $request->user_id,
        //        'order_date' => Carbon::now(),
        //        'payment_method' => 'stripe',
        //        'address_id' => $address->id,
        //        'order_total' => $request->total,
        //        'status' => 0,
        //     ]);


            // Set your Stripe API key.
        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // // Get the payment amount and email address from the form.
        // $amount = $request->input('total') * 100;
        // $email = $request->input('email');

        // // Create a new Stripe customer.
        // $customer = \Stripe\Customer::create([
        //     'email' => $email,
        //     'source' => $request->input('stripeToken'),
        // ]);

        // // Create a new Stripe charge.
        // $charge = \Stripe\Charge::create([
        //     'customer' => $customer->id,
        //     'amount' => $amount,
        //     'currency' => 'usd',
        // ]);


        // return redirect('/thank-you' + '/' + 'orderId');

    }


    public function thankYou($id){
        return view('frontend.thanks' , ['id' => $id]);
    }

    // public function dummy(){
    //     // $carts = session()->get('cart');
    //     // print_r($carts);
    //     // $carts = Auth::user()->with('shoppingCart')->get();
    //     // return view('frontend.checkout')->with($data);
    // }

}