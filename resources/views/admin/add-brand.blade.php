@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Add a New Brand</h1>
                    <a class="btn btn-primary" href="{{ route('admin.show-brand') }}" >Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.add-brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="brand">Brand Name</label>
                                    <input type="text" class="form-control" id="brand" name="name" value="">
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
