@extends('frontend.layouts.main')
@section('main-container')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                {{-- <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                @if ($subcategories->isNotEmpty())
                                                    @foreach ($subcategories as $subcategory)
                                                        <li><a href="#">{{ $subcategory->name }}</a></li>
                                                    @endforeach
                                                @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="categories__accordion">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card" style="padding-bottom: 20px">
                                            <div class="card-heading">
                                                {{-- <a data-toggle="collapse" data-target="#collapseOne">{{$category->name}}</a> --}}
                                                <a data-target="#collapseOne" data-toggle="collapse" style="text-decoration: none">Categories</a>
                                            </div>
                                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        @if($categories->isNotEmpty())
                                                            @foreach ($categories as $key => $category)
                                                                <div class="card">
                                                                    <div class="card-heading">
                                                                        {{-- <a data-toggle="collapse" data-target="#collapseOne">{{$category->name}}</a> --}}
                                                                        @if ($category->subcategories->isNotEmpty())
                                                                        <a data-target="#collapse-{{ $key }}" class="{{ ($categorySelected == $category->id) ? 'text-warning' : '' }}" data-toggle="collapse" style="text-decoration: none; font-weight:inherit; font-size:15px">{{ $category->name }}</a>
                                                                        @else
                                                                        <a href="{{ route('shop', $category->slug) }}" style="text-decoration: none; font-weight:inherit; font-size:15px">{{ $category->name }}</a>
                                                                        @endif
                                                                    </div>
                                                                    @if ($category->subcategories->isNotEmpty())
                                                                        <div id="collapse-{{ $key }}" class="collapse {{ ($categorySelected == $category->id) ? 'show' : '' }}" >
                                                                            <div class="card-body">
                                                                                <ul>
                                                                                    @foreach ($category->subcategories as $sub_category)
                                                                                        <li><a href="{{ route('shop', [$category->slug , $sub_category->slug]) }}"  class="{{ ($subCategorySelected == $sub_category->id) ? 'text-dark' : '' }}" style="text-decoration: none; font-weight:inherit; font-size:14px; color:darkgray">{{ $sub_category->name }}</a></li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" class="brand" data-target="#collapseTwo">Brands</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    @if ($brands->isNotEmpty())
                                                        @foreach ($brands as $brand)
                                                            {{-- <li><a href="#">{{ $brand->name }}</a></li> --}}
                                                            <input {{ (in_array($brand->id , $brandsArray)) ? 'checked' : '' }} type="checkbox" class="brand" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                                            <label for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                                            <br>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                {{-- <ul>
                                                    <li><a href="#">$0.00 - $50.00</a></li>
                                                    <li><a href="#">$50.00 - $100.00</a></li>
                                                    <li><a href="#">$100.00 - $150.00</a></li>
                                                    <li><a href="#">$150.00 - $200.00</a></li>
                                                    <li><a href="#">$200.00 - $250.00</a></li>
                                                    <li><a href="#">250.00+</a></li>
                                                </ul> --}}
                                                <input type="text" class="js-range-slider text-warning" name="my_range" value="" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                <label for="xs">xs
                                                    <input type="radio" id="xs">
                                                </label>
                                                <label for="sm">s
                                                    <input type="radio" id="sm">
                                                </label>
                                                <label for="md">m
                                                    <input type="radio" id="md">
                                                </label>
                                                <label for="xl">xl
                                                    <input type="radio" id="xl">
                                                </label>
                                                <label for="2xl">2xl
                                                    <input type="radio" id="2xl">
                                                </label>
                                                <label for="xxl">xxl
                                                    <input type="radio" id="xxl">
                                                </label>
                                                <label for="3xl">3xl
                                                    <input type="radio" id="3xl">
                                                </label>
                                                <label for="4xl">4xl
                                                    <input type="radio" id="4xl">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                <label class="c-1" for="sp-1">
                                                    <input type="radio" id="sp-1">
                                                </label>
                                                <label class="c-2" for="sp-2">
                                                    <input type="radio" id="sp-2">
                                                </label>
                                                <label class="c-3" for="sp-3">
                                                    <input type="radio" id="sp-3">
                                                </label>
                                                <label class="c-4" for="sp-4">
                                                    <input type="radio" id="sp-4">
                                                </label>
                                                <label class="c-5" for="sp-5">
                                                    <input type="radio" id="sp-5">
                                                </label>
                                                <label class="c-6" for="sp-6">
                                                    <input type="radio" id="sp-6">
                                                </label>
                                                <label class="c-7" for="sp-7">
                                                    <input type="radio" id="sp-7">
                                                </label>
                                                <label class="c-8" for="sp-8">
                                                    <input type="radio" id="sp-8">
                                                </label>
                                                <label class="c-9" for="sp-9">
                                                    <input type="radio" id="sp-9">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">Product</a>
                                                <a href="#">Bags</a>
                                                <a href="#">Shoes</a>
                                                <a href="#">Fashio</a>
                                                <a href="#">Clothing</a>
                                                <a href="#">Hats</a>
                                                <a href="#">Accessories</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select name="sort" id="sort">
                                        <option value="latest" {{ ($sort == 'latest') ? 'selected' : ''}}>Latest</option>
                                        <option value="price_desc" {{ ($sort == 'price_desc') ? 'selected' : ''}}>Price High</option>
                                        <option value="price_asc" {{ ($sort == 'price_asc') ? 'selected' : ''}}>Price Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- @dd($photo) --}}
                        @if ($products->isNotEmpty())
                            {{-- @dd($products) --}}
                            {{-- @dd($products->product_image->image) --}}
                            @foreach ($products as $product)
                            {{-- @php
                            $productImage = $product->photo->first();
                            @endphp --}}

                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item sale">
                                        @if ($product->product_image->isNotEmpty())
                                        <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_image[0]->image)}}">
                                        {{-- <div class="product__item__pic set-bg" data-setbg="{{ asset('frontend/img/product/product-6.jpg')}}"> --}}
                                        @endif
                                            {{-- <span class="label">Sale</span> --}}
                                            <ul class="product__hover">
                                                <li><a href=""><img src="{{ asset('frontend/img/icon/heart.png')}}" alt=""></a></li>
                                                <li><a href="#"><img src="{{ asset('frontend/img/icon/compare.png')}}" alt=""> <span>Compare</span></a>
                                                </li>
                                                <li><a href="{{ route('detail', [$product->id ,$product->slug ]) }}"><img src="{{ asset('frontend/img/icon/search.png')}}" alt=""></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6>{{ $product->title }}</h6>
                                            <a href="{{route('add.to.cart' , $product->id)}}" class="add-cart">+ Add To Cart</a>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <span class="d-flex">
                                            <p class="px-1">${{ $product->price }}</p>
                                            <p class="px-1"><del>${{ $product->compare_price }}</del></p>
                                            </span>
                                            <div class="product__color__select">
                                                <label for="pc-16">
                                                    <input type="radio" id="pc-16">
                                                </label>
                                                <label class="active black" for="pc-17">
                                                    <input type="radio" id="pc-17">
                                                </label>
                                                <label class="grey" for="pc-18">
                                                    <input type="radio" id="pc-18">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-danger">No Product Found</div>
                        @endif


                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection



{{-- <script>
    $(document).ready(function(){
        $('.addToCartBtn').click(function (e) {
            e.preventDefault();

            var product_id = $(this).closest('.product_data').find('.product_id').val();
            var quantity = $(this).closest('.product_data').find('.qty-input').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/add-to-cart/" + product_id + "/" +quantity,
                // method: "PATCH",
                data: {
                    'product_id' : product_id,
                    'quantity' : quantity,
                },
                success: function (response) {
                    alert(response.status);
                    // console.log(response.data);
                }
            });
        });

    });

</script> --}}
