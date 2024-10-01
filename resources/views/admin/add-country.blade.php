@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Add Shipping Country</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.add-country') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                              <div class="col-md-12 mt-2">
                                    <label for="name">Country Name</label>
                                    <input type="text" class="form-control" id="" name="name" value="">
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary mt-2" type="submit">Finish</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
