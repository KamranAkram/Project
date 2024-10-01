@extends('frontend.layouts.main')
@section('main-container')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $subtotal = 0;
                                    // $single_total = 0;
                                @endphp
                                @if ($carts != null)
                                    @foreach ($carts as $id => $cart)
                                        <tr data-id="{{ $id }}">
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    {{-- @dd($cart); --}}
                                                    <img src="{{ asset($cart['image']) }}" alt="" height="100px" width="100px">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>{{ $cart['title'] }}</h6>
                                                    <h5>{{ $cart['price'] }}</h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    {{-- <div class="pro-qty-2"> --}}
                                                    {{-- <input type="number" value="{{ $cart['quantity'] }}" name="qty" class="qty update-cart"> --}}
                                                    <input type="number" class="form-control text-center qty update-cart"
                                                        value="{{ $cart['quantity'] }}" style="width: 40%; border:none;">
                                                    {{-- <input type="number" class="form-control text-center qty update-cart" value="{{ $cart['quantity'] }}"> --}}
                                                    {{-- </div> --}}
                                                </div>
                                            </td>
                                            @php
                                                $single_total = 0;
                                                $single_total += $cart['price'] * $cart['quantity'];
                                                $subtotal += $single_total;
                                            @endphp

                                            <td class="cart__price">{{ $single_total }}</td>
                                            <td class="cart__close"><i class="fa fa-close remove-from-cart"></i></td>
                                        </tr>
                                    @endforeach
                                @else
                                    {{-- <span class="text-danger">Cart is empty</span> --}}
                                    <div class="alert alert-danger">Cart Is Empty</div>
                                @endif
                                {{-- <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('frontend/img/shopping-cart/cart-2.jpg')}}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>Diagonal Textured Cap</h6>
                                            <h5>$98.49</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 32.50</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('frontend/img/shopping-cart/cart-3.jpg')}}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>Basic Flowing Scarf</h6>
                                            <h5>$98.49</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 47.00</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('frontend/img/shopping-cart/cart-4.jpg')}}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>Basic Flowing Scarf</h6>
                                            <h5>$98.49</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 30.00</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        @php
                            $shipping = 10;
                            $total = $subtotal + $shipping;
                        @endphp
                        <ul>
                            <li>Subtotal <span>${{ $subtotal }}</span></li>
                            <li>Shipping <span>${{ $shipping }}</span></li>
                            <li>Total <span>${{ $total }}</span></li>
                        </ul>
                        <a href="{{ route('check') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection

{{-- <script>
    $(".update-cart").change(function (e) {
        // alert('Success!');

        var ele = $(this);


        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "post",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".qty").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script> --}}
