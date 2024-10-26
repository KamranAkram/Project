@extends('frontend.layouts.main')
@section('main-container')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="" method="POST" id="orderForm" name="orderForm" enctype="multipart/form-data">
                    @csrf
					<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Name<span>*</span></p>
                                        {{-- <input type="text" name="name" class="text-dark" value="{{Auth::user()->name}}"> --}}
                                        <input type="text" name="name" id="name" class="text-dark" value="{{ (!empty($address)) ? $address->name : ''}}">
                                        {{-- <span class="text-danger"> --}}
                                            {{-- @error('name')
                                                {{ $message }}
                                            @enderror --}}
                                            <p class="text-danger"></p>
                                        {{-- </span> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div> --}}
                                {{-- </div> --}}
                                <div class="col-lg-12 mb-2">
                                    <div class="checkout__input">
                                        <p>Country<span>*</span></p>
                                        {{-- <label for="">Country</label> --}}
                                        {{-- <input type="select" name="country_id"> --}}
                                        <select id="country" class="form-control" name="country">
                                            <option value="" disabled>Select a Country</option>
                                            @foreach ($countries as $value)
                                                <option {{ (!empty($address) && $address->country_id == $value->id) ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Address<span>*</span></p>
                                        <input type="text" id="address" value="{{ (!empty($address)) ? $address->address : ''}}" name="address" placeholder="Address" class="checkout__input__add">
                                        {{-- <span class="text-danger"> --}}
                                            {{-- @error('address')
                                                {{ $message }}
                                            @enderror --}}
                                        {{-- </span> --}}
                                        <p class="text-danger"></p>
                                        <input type="text" id="apartment" name="apartment" value="{{ (!empty($address)) ? $address->apartment : ''}}" placeholder="Apartment Address">
                                        {{-- <input type="text" name="postal_address" placeholder="Postal Address Apartment, suite, unite ect (optinal)"> --}}
                                        {{-- <textarea name="address" id="address" cols="84" rows="10"></textarea> --}}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Town/City<span>*</span></p>
                                        <input type="text" id="city" name="city" value="{{ (!empty($address)) ? $address->city : ''}}">
                                        {{-- <span class="text-danger"> --}}
                                            {{-- @error('city')
                                                {{ $message }}
                                            @enderror --}}
                                            <p class="text-danger"></p>
                                        {{-- </span> --}}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Country/State<span>*</span></p>
                                        <input type="text" id="region" name="region" value="{{ (!empty($address)) ? $address->region : ''}}">
                                        {{-- <span class="text-danger"> --}}
                                            {{-- @error('region')
                                                {{ $message }}
                                            @enderror --}}
                                            <p class="text-danger"></p>
                                        {{-- </span> --}}
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Postcode / ZIP<span>*</span></p>
                                        <input type="text" id="zip" name="zip" value="{{ (!empty($address)) ? $address->zip : ''}}">
                                        {{-- <span class="text-danger">
                                            @error('zip')
                                                {{ $message }}
                                            @enderror
                                        </span> --}}
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" id="phone" name="phone" value="{{ (!empty($address)) ? $address->phone : ''}}">
                                        {{-- <span class="text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </span> --}}
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" id="email" name="email" class="text-dark" value="{{ (!empty($address)) ? $address->email : ''}}">
                                        {{-- <span class="text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </span> --}}
                                        <p class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div> --}}
                        </div>
                        @php
							$subtotal = 0;
                            // if ($carts) {
                            //     $shipping = 10;
                            // }else {
                                $shipping = 0;
                            // }
						@endphp
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products"><strong>Product</strong> <span><strong>Total</strong></span></div>
                                <ul class="checkout__total__products">
                                    @if ($carts!=null)
                                        @foreach($carts as $cart)
											@php
												$single_total = 0;
												$single_total += $cart->price * $cart->qty;
												// $subtotal += $single_total;
											@endphp
											<li><strong>{{$cart->name}}</strong> X <strong>{{ $cart->qty }}</strong> <span><strong>${{$single_total}}</strong></span></li>
										@endforeach
                                    @endif
                                    {{-- <li>01. Vanilla salted caramel <span>$ 300.0</span></li>
                                    <li>02. German chocolate <span>$ 170.0</span></li>
                                    <li>03. Sweet autumn <span>$ 170.0</span></li>
                                    <li>04. Cluten free mini dozen <span>$ 110.0</span></li> --}}
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                    <li>Shipping Fee <span>${{ $shipping }}</span></li>
                                        {{-- @php
                                            $total = $subtotal + $shipping;
                                        @endphp --}}
										<input type="hidden" name="total" value="{{Cart::subtotal()}}">

                                    <li>Total <span>${{Cart::subtotal()}}</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                {{-- <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p> --}}
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="cod">
                                        COD
                                        <input type="checkbox" id="cod" name="payment" value="cod">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <div class="">
                                    {{-- <label for="cod"> --}}
                                        {{-- COD --}}
                                        <input type="radio" checked id="payment_method_one" name="payment" value="cod">
                                        <label for="payment_method_one">COD</label>
                                        {{-- <span class="checkmark"></span> --}}
                                    {{-- </label> --}}
                                </div>
                                <div class="">
                                    <input type="radio" id="payment_method_two" name="payment" value="stripe">
                                    <label for="payment_method_two">Stripe</label>
                                </div>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        COD
                                        <input type="checkbox" id="cod" name="cod" value="cod">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                {{-- <div id="accordion"> --}}
                                    <div class="card payment-form">
                                        {{-- <div class="card-header">
                                            <div class="form-group">
                                                '<div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="payment" data-bs-toggle="collapse" value="stripe" href="#collapseTwo" id="stripe">
                                                    <label class="custom-control-label" for="stripe">Stripe</label>
                                                </div>'
                                            </div>
                                        </div> --}}
                                        {{-- <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <h3 class="text-center" >Payment Details</h3>
                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 form-group required'>
                                                                <label class='control-label'>Name on Card</label>
                                                                <input class='form-control' size='4' type='text'>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 form-group required'>
                                                                <label class='control-label'>Card Number</label>
                                                                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                <label class='control-label'>CVC No.</label> <input autocomplete='off'
                                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                type='text'>
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                <label class='control-label'>Exp. Month</label> <input
                                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                                type='text'>
                                                            </div>
                                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                <label class='control-label'>Exp. Year</label> <input
                                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                                type='text'>
                                                            </div>
                                                        </div>

                                                        <div class='form-row row'>
                                                            <div class='col-md-12 error form-group hide'>
                                                                <div class='alert-danger alert'>Please correct the errors and try
                                                                    again.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="card-body d-none" id="card-payment-form">
                                            <div class="container">
                                                <div class="row">
                                                    <h3 class="text-center" >Payment Details</h3>
                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 form-group required'>
                                                            <label class='control-label'>Name on Card</label>
                                                            <input class='form-control' size='4' type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 form-group required'>
                                                            <label class='control-label'>Card Number</label>
                                                            <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                            <label class='control-label'>CVC No.</label> <input autocomplete='off'
                                                            class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                            type='text'>
                                                        </div>
                                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                            <label class='control-label'>Exp. Month</label> <input
                                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                                            type='text'>
                                                        </div>
                                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                            <label class='control-label'>Exp. Year</label> <input
                                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                            type='text'>
                                                        </div>
                                                    </div>

                                                    <div class='form-row row'>
                                                        <div class='col-md-12 error form-group hide'>
                                                            <div class='alert-danger alert'>Please correct the errors and try
                                                                again.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                                {{-- <div class="card-body">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="payment" data-bs-toggle="collapse" href="#collapseTwo" id="stripe">
                                                        <label class="custom-control-label" for="stripe">Stripe</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <h3 class="text-center" >Payment Details</h3>
                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group required'>
                                                                    <label class='control-label'>Name on Card</label>
                                                                    <input class='form-control' size='4' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 form-group required'>
                                                                    <label class='control-label'>Card Number</label>
                                                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                                    <label class='control-label'>CVC No.</label> <input autocomplete='off'
                                                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                    type='text'>
                                                                </div>
                                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Exp. Month</label> <input
                                                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                                                    type='text'>
                                                                </div>
                                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                                    <label class='control-label'>Exp. Year</label> <input
                                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                                    type='text'>
                                                                </div>
                                                            </div>

                                                            <div class='form-row row'>
                                                                <div class='col-md-12 error form-group hide'>
                                                                    <div class='alert-danger alert'>Please correct the errors and try
                                                                        again.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection


@section('customJs')
    <script>
        $("#payment_method_one").click(function () {
            if($(this).is(":checked") == true){
                $("#card-payment-form").addClass('d-none')
            }
        });

        $("#payment_method_two").click(function () {
            if($(this).is(":checked") == true){
                $("#card-payment-form").removeClass('d-none')
            }
        });

        $("#orderForm").submit(function (event) {
            event.preventDefault();
            $('button[type="submit"]').prop('disable', true);
            $.ajax({
                type: 'post',
                url: '{{ route("check-out") }}',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function (response) {
                    var errors = response.errors;
                    $('button[type="submit"]').prop('disable', false);
                    if(response.status == false){
                        if(errors.name){
                            $("#name").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.name);
                        }else{
                            $("#name").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.country){
                            $("#country").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.country);
                        }else{
                            $("#country").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.address){
                            $("#address").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.address);
                        }else{
                            $("#address").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.city){
                            $("#city").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.city);
                        }else{
                            $("#city").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.region){
                            $("#region").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.region);
                        }else{
                            $("#region").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.zip){
                            $("#zip").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.zip);
                        }else{
                            $("#zip").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.phone){
                            $("#phone").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.phone);
                        }else{
                            $("#phone").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                        if(errors.email){
                            $("#email").addClass('is-invalid')
                            .siblings("p")
                            .addClass('invalid-feedback')
                            .html(errors.email);
                        }else{
                            $("#email").removeClass('is-invalid')
                            .siblings("p")
                            .removeClass('invalid-feedback')
                            .html('');
                        }
                    }else{
                        window.location.href = "{{ url('/thank-you/') }}/" + response.orderId;
                    }


                }
            });
        });
    </script>
@endsection
