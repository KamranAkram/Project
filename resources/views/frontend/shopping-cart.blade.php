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
                @if(Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if(Session::has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                @endif

                @if ($carts->isNotEmpty())
                    <div class="col-lg-8">
                        <div class="shopping__cart__table align-items-center">
                            <table>
                                <thead class="px-3">
                                    <tr>
                                        <th class="px-1"></th>
                                        <th class="px-1">Product</th>
                                        <th class="px-1">Price</th>
                                        <th class="px-3">Quantity</th>
                                        <th class="px-1">Total</th>
                                        <th class="px-1">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @php
                                        $subtotal = 0;
                                        // $single_total = 0;
                                    @endphp --}}
                                        {{-- @foreach ($carts as $id => $cart) --}}
                                        @foreach ($carts as $cart)
                                            {{-- <tr data-id="{{ $id }}"> --}}
                                            <tr>
                                                <td class="product__cart__item">
                                                    @if ($cart->options->productImage)
                                                    {{-- <div class="product__cart__item__pic set-bg" data-setbg="{{ asset($cart->options->productImage)}}" style="height: 100px; width:100px" > --}}
                                                        <img src="{{ asset($cart->options->productImage)}}" style="height: 90px; width:100px" alt="">
                                                    @endif
                                                    {{-- <img src="{{ asset($cart['image']) }}" alt="" height="100px" width="100px"> --}}
                                                    {{-- </div> --}}
                                                </td>
                                                <td class="product__cart__item pl-3">
                                                    {{-- <div class="d-flex align-items-center justify-content-start"> --}}
                                                        {{-- @dd($cart); --}}

                                                        {{-- <div class="product__cart__item__text"> --}}
                                                            <h6>{{ $cart->name }}</h6>
                                                            {{-- <h5>{{ $cart->price }}</h5> --}}
                                                        {{-- </div> --}}
                                                    {{-- </div> --}}
                                                </td>
                                                <td class="product__cart__item pl-2">{{ $cart->price }}</td>
                                                <td class="quantity__item">
                                                    <div class="quantity d-flex px-3" >
                                                        {{-- <div class="pro-qty-2"> --}}
                                                        {{-- <input type="text" value="{{ $cart->qty }}" name="qty" > --}}
                                                        {{-- <span class="dec qtybtn"></span>
                                                        <input type="text" value="{{ $cart->qty }}" name="qty">
                                                        <span class="inc qtybtn"></span> --}}
                                                        {{-- <input type="number" class="form-control text-center qty update-cart"
                                                            value="{{ $cart->qty }}" style="width: 60%; border:none;"> --}}
                                                        {{-- <input type="number" class="form-control text-center qty update-cart" value="{{ $cart['quantity'] }}"> --}}
                                                        {{-- </div> --}}
                                                        <div class="input-group-btn">
                                                            <button class="btn border-0 sub" data-id="{{ $cart->rowId }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                            <input type="text" class="form-control form-control-sm border-0" value="{{ $cart->qty }}" name="qty">
                                                        <div class="input-group-btn">
                                                            <button class="btn border-0 add" data-id="{{ $cart->rowId }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                {{-- @php
                                                    $single_total = 0;
                                                    $single_total += $cart['price'] * $cart['quantity'];
                                                    $subtotal += $single_total;
                                                @endphp --}}

                                                {{-- <td class="cart__price">{{ $single_total }}</td> --}}
                                                <td class="cart__price pl-2">${{ $cart->price * $cart->qty }}</td>
                                                <td class="cart__close pl-4"><i class="fa fa-close remove-from-cart" onclick="deleteItem('{{ $cart->rowId }}')"></i></td>
                                            </tr>
                                        @endforeach
                                    {{-- @else
                                        <span class="text-danger">Cart is empty</span>
                                        <div class="alert alert-danger">Cart Is Empty</div>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Cart Is Empty!</h5>
                                                <p class="card-text">Content</p>
                                            </div>
                                        </div>
                                    @endif --}}
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
                            {{-- @php
                                $shipping = 0;
                                $total = $subtotal + $shipping;
                            @endphp --}}
                            <ul>
                                {{-- <li>Subtotal <span>${{ $subtotal }}</span></li> --}}
                                <li>Subtotal <span>${{ Cart::subtotal() }}</span></li>
                                {{-- <li>Shipping <span>${{ $shipping }}</span></li> --}}
                                {{-- <li>Total <span>${{ $total }}</span></li> --}}
                            </ul>
                            <a href="{{ route('check') }}" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                @else
                {{-- <span class="text-danger">Cart is empty</span> --}}
                {{-- <div class="alert alert-danger">Cart Is Empty</div> --}}
                <div class="card text-secondary" style="border:none;">
                    <div class="card-body">
                        <h2 class="card-title text-center text-secondary" style="font-family: serif; font-weight:bold">Your Cart is Empty!</h2>
                        {{-- <p class="card-text">Content</p> --}}
                    </div>
                </div>
                @endif

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
@section('customJs')
<script>
    $('.add').click(function(){
        var qtyElement = $(this).parent().prev();
        var qtyValue = parseInt(qtyElement.val());
        if(qtyValue < 10){
            var rowId = $(this).data('id');
            qtyElement.val(qtyValue+1);
            var newQty = qtyElement.val();
            updateCart(rowId,newQty);
        }
    });
    $('.sub').click(function(){
        var qtyElement = $(this).parent().next();
        var qtyValue = parseInt(qtyElement.val());
        if(qtyValue > 1){
            var rowId = $(this).data('id');
            qtyElement.val(qtyValue-1);
            var newQty = qtyElement.val();
            updateCart(rowId,newQty);
        }
    });

    function updateCart(rowId,qty){
        $.ajax({
            type: "post",
            url: "{{ route('update.cart') }}",
            data: {rowId:rowId, qty:qty},
            dataType: "json",
            success: function (response) {
                // if(response.status == true){
                    window.location.href = '{{ route("cart") }}';
                // }
            }
        });
    }

    function deleteItem(rowId){
        if(confirm("Are you sure you want to delete this?")){
            $.ajax({
                type: "post",
                url: "{{ route('remove.from.cart') }}",
                data: {rowId:rowId},
                dataType: "json",
                success: function (response) {
                    // if(response.status == true){
                        window.location.href = '{{ route("cart") }}';
                    // }
                }
            });
        }
    }
</script>
@endsection
