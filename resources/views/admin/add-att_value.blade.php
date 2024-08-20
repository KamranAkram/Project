@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Add Attribte Value</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.add-att-value') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="attribute">Attribute Name</label>
                                    <select id="attribute" class="form-control" name="attribute_id">
                                        @foreach ($attributes as $attribute)
                                            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('attribute_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="value">Attribute Value</label>
                                    <input type="text" class="form-control" id="value" name="value" value="">
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
