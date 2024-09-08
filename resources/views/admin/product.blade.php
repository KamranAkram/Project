@extends('admin.admin-layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Products</h1>
                    <a class="btn btn-primary" href="{{ route('admin.product') }}">Add Products</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-success text-center">
                                <tr>
                                    <th scope="col">Sr #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">SubCategory</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Compared Price</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Track Quantity</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Add/Remove Images</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $product)
                                    <tr class="">
                                        <td scope="row">{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->cat_id }}</td>
                                        <td>{{ $product->sub_cat_id }}</td>
                                        <td>{{ $product->brand_id }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->compare_price }}</td>
                                        <td>{{ $product->is_featured }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->track_qty }}</td>
                                        <td>{{ $product->qty}}</td>
                                        {{-- <td>{{ $product->status }}</td> --}}
                                        <td>
                                            @if($product->status == 1)
                                            <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @elseif($product->status == 0)
                                            <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.image-product', $product->id)}}" class="btn btn-info">
                                                {{-- <i data-feather=""></i> --}}
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.edit-product', $product->id)}}" class="text-info px-1">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="{{route('admin.delete-product', $product->id)}}" class="text-danger px-1">
                                                <i data-feather="trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    {{ $products->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
