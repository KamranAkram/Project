@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Add New Product</h1>
                    <a class="btn btn-primary" href="{{ route('admin.show-product') }}" >Back</a>
                </div>
                <div class="card-body">
                    <form action="" method="POST"  id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="">
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly class="form-control" id="slug" name="slug" value="">
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="desc">Description</label>
                                    <textarea name="description" id="desc" cols="100" rows="10"></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="cat">Category Name</label>
                                    <select id="cat" class="form-control" name="cat_id">
                                        <option value="">Select a Category</option>
                                        @foreach ($categories as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="sub_cat">SubCategory</label>
                                    <select id="sub_cat" class="form-control" name="sub_cat_id">
                                        <option value="">Select a Sub-Category</option>
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-12 py-2">
                                    {{-- <label for="sub_cat">Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    <p class="error"></p> --}}

                                    {{-- <div class="card mb-3"> --}}
                                        {{-- <div class="card-body"> --}}
                                            {{-- <h2 class="h4 mb-3">Media</h2> --}}
                                            <input type="hidden" name="image_id" id="image_id">
                                            <label for="image">Image</label>
                                            <div id="image" class="dropzone dz-clickable">
                                                <div class="dz-message needsclick">
                                                    <br>Drop files here or click to upload.<br><br>
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                </div>
                                <div class="row duplicate-row" id="duplicate-row">
                                    <div class="col-md-10 first" id="first">
                                        <div class="row">
                                            <div class="col-md-5 mt-2">
                                                <label for="attribute">Attribute Name</label>
                                                <select id="attribute" class="form-control" name="attribute_id">
                                                    <option value="">Select an Attribute</option>
                                                    @foreach ($attributes as $attribute)
                                                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p class="error"></p>
                                            </div>

                                            <div class="col-md-5 mt-2">
                                                <label for="value">Attribute Value</label>
                                                <select id="value" class="form-select" name="value_id[]" multiple aria-label="multiple select">
                                                    <option value="">Select the Attribute Values</option>
                                                </select>
                                                <p class="error"></p>
                                            </div>
                                            <div class="col-md-2" style="margin-top: 2rem;">
                                                <input type="button" value="Remove" class="btn btn-danger" id="btn-remove" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <br>
                                        <div class="float-right">
                                            <input type="button" value="Add More" class="btn btn-primary button" id="addmorebtn" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="brand">Brand</label>
                                    <select id="brand" class="form-control" name="brand_id">
                                        <option value="">Select a Brand</option>
                                        @foreach ($brands as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price" value="">
                                    <p class="error"></p>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="compare_price">Compared Price</label>
                                    <input type="text" class="form-control" id="compare_price" name="compare_price" value="">
                                    <p class="error"></p>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="is_featured">Feature Product</label>
                                    <select id="is_featured" class="form-control" name="is_featured">
                                        <option value="">Select One</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="row">
                                <h4 class="mt-2">Inventory</h4>
                                    <div class="col-md-6 mt-2">
                                        <label for="sku">SKU</label>
                                        <input type="text" class="form-control" id="sku" name="sku" value="">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <input type="hidden" name="track_qty" value="No">
                                        <input type="checkbox" name="track_qty" id="track_qty" value="Yes" checked>
                                        <label for="qty">Track Quantity</label>
                                        <input type="number" class="form-control" id="qty" name="qty" value="">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="status">Status</label>
                                        <select id="status" class="form-control" name="status">
                                            <option value="">Select One</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                        <p class="error"></p>
                                    </div>
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

@section('customJS')

{{-- /<script>
    Dropzone.autoDiscover = false;
    // $(function () {
    //     // Summernote
    //     $('.summernote').summernote({
    //         height: '300px'
    //     });

        const dropzone = $("#image").dropzone({
            init: function(){
                this.on('addedfile' ,function(file){
                    if(this.files.length > 1){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{route('admin.temp-images.create')}}",
            maxFiles: 5,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
            }
        });

    // });
</script> --}}

<script>
    $("#productForm").submit(function (event) {
        event.preventDefault();
        var formArray = $(this).serializeArray();
        // console.log(formArray);
        $("button[type='submit']").prop('disable',true);
        $.ajax({
            type: "post",
            url: "{{ route('admin.add-product') }}",
            data: formArray,
            dataType: "json",
            success: function (response) {
                $("button[type='submit']").prop('disable',false);
                if(response['status'] == true){

                }else{
                    var errors = response['errors'];

                    $('.error').removeClass('invalid-feedback').html('');
                    $.each(errors, function(key, value){
                        $(`#${key}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                    });
                }
            }
        });
    });


    $('#cat').change(function(){
        var cat_id = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ route('admin.product-subcat') }}",
            data: {cat_id :cat_id},
            dataType: "json",
            success: function (response) {
                $("#sub_cat").find("option").not(":first").remove();
                $.each(response["sub_categories"], function(key, item){
                    $("#sub_cat").append(`<option value='${item.id}'>${item.name}</option>`)
                });
            },
            error: function(){
                console.log("Something Went Wrong");
            }
        });
    });

    $('#attribute').change(function(){
        var attribute_id = $(this).val();
        $.ajax({
            type: "get",
            url: "{{ route('admin.product-value') }}",
            data: {attribute_id :attribute_id},
            dataType: "json",
            success: function (response) {
                $("#value").find("option").not(":first").remove();
                $.each(response["att_values"], function(key, item){
                    $("#value").append(`<option value='${item.id}'>${item.value}</option>`)
                });
            },
            error: function(){
                console.log("Something Went Wrong");
            }
        });
    });

    $(document).ready(function(){
            $(".button").click(function(){
            $('.first').clone().appendTo('.duplicate-row');
            });
            $(document).on('click', '#btn-remove' ,function(){
                if($("#duplicate-row #first").length > 1)
                {
                    $(this).parents("#first").remove();
                }
            });
        });
</script>

@endsection
