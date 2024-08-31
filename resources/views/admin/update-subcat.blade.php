@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Update Sub-Category</h1>
                    <a class="btn btn-primary" href="{{ route('admin.show-subcat') }}" >Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update-sub-cat' ,$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="cat">Category Name</label>
                                    <select id="cat" class="form-control" name="cat_id">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('cat_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="sub">Sub-Category Name</label>
                                    <input type="text" class="form-control" id="sub" name="name" value="{{ $subcategory->name }}">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="slug">Slug</label>
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
