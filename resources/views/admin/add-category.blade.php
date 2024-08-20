@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Add a New Category</h1>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary float-right" href="{{ route('admin.show-cat') }}" >Categories</a>

                    <form action="{{ route('admin.add-cat') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="name">Category Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="">Slug</label>
                                    <input type="text" readonly class="form-control" id="slug" name="slug" value="">
                                    <span class="text-danger">
                                        @error('slug')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                </div>



                                {{-- <div class="col-md-6 mt-2">
                                    <label for="">Location</label>
                                    <input type="text" class="form-control" id="" name="location" value="">
                                </div> --}}

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


