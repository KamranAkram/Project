<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ShopOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Climate\Order;

// use subtotal;

class CheckoutController extends Controller
{
    public function checkOut(Request $request){
        $data['carts'] = session()->get('cart');
        $data['users'] = User::all();
        $data['countries'] = Country::all();
        $data['products'] = Product::all();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        return view('frontend.checkout')->with($data);
    }

    public function storeAddress(Request $request){
         @dd($request->all());
            // Apply Validation

            $request->validate(
                [
                    'name'     => 'required|min:5',
                    'email'     => 'required|email',
                    'phone'     => 'required',
                    'country'    => 'required',
                    'address' => 'required|min:30',
                    'zip'          => 'required',
                    'city'          => 'required',
                    'region'        => 'required',
                    'postal_code'   => 'required',
                ]
            );

            // dd($request->all());


            // Store User Address
            $user = Auth::user();
            $carts = session()->get('cart');


            // Address::Create(
            //     ['user_id' => $user->id],
            //     [
            //         'user_id' => $user->id,
            //         'name' => $request->name,
            //         'email' => $request->email,
            //         'phone' => $request->phone,
            //         'country_id' => $request->country,
            //         'address' => $request->address,
            //         'apartment' => $request->apartment,
            //         'city' => $request->city,
            //         'region' => $request->region,
            //         'zip' => $request->zip,
            //     ]
            // );
            $address = Address::create([
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
            ]);


            // Store Order Data

            if($request->payment == 'stripe'){
                // $shipping = 0;
                $discount = 0;
                $subTotal = $request->subtotal;
                $grandTotal = $request->total;
                $order = new ShopOrder;
                $order->subtotal = $subTotal;
                $order->shipping = $request->shipping;
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
                foreach($carts as $item){
                    $orderItem = new OrderLine;

                    $orderItem->product_id = $item->id;
                    $orderItem->order_id = $order->id;
                    $orderItem->name = $item->name;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $item->price;
                    $orderItem->total = $item->quantity * $item->price;
                    $orderItem->save();
                    // $orderItem->update($orderItem);
                }

                session()->flash('success' , 'Your order has been successfully placed');
                return response()->json([
                    'status' => true,
                    'orderId' => $order->id,
                    'message' => 'Order saved Successfully',
                ]);
            }else{
                //
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
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Get the payment amount and email address from the form.
        $amount = $request->input('total') * 100;
        $email = $request->input('email');

        // Create a new Stripe customer.
        $customer = \Stripe\Customer::create([
            'email' => $email,
            'source' => $request->input('stripeToken'),
        ]);

        // Create a new Stripe charge.
        $charge = \Stripe\Charge::create([
            'customer' => $customer->id,
            'amount' => $amount,
            'currency' => 'usd',
        ]);


        return redirect('/thank-you' + '/' + 'orderId');

    }


    public function thankYou(){
        return view('frontend.thanks');
    }
}