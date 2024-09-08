@extends('admin.admin-layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Upload Product Images</h1>
                    <a class="btn btn-primary" href="{{ route('admin.show-product') }}">Products</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <h4>Product Name : {{ $product->title }}</h4>

                    @if($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form action="{{ route('admin.store-images' , $product->id) }}" method="POST" id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">

                                <div class="col-md-12 mt-2">
                                    <label for="image">Image</label>
                                    <input type="file" name="images[]" multiple class="form-control" id="image">
                                    <p class="error"></p>
                                    {{-- <div class="card mb-3">
                                        <div class="card-body">
                                            <h2 class="h4 mb-3">Media</h2>
                                            <input type="file" name="image[]" id="image">
                                        </div>
                                    </div> --}}
                                </div>



                                <div class="col-12">
                                    <button class="btn btn-primary mt-3" type="submit">Finish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

