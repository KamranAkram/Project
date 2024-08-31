@extends('admin.admin-layouts.layout')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="text-center text-primary pt-2" style="font-weight: bold">Update Blog</h1>
                <a class="btn btn-primary" href="{{ route('admin.show-blog') }}" >Blogs</a>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.update-blog' , $blog->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-4 card bg-white p-3">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label for="image">Image:</label>
                                    <input type="file" class="form-control" id="" name="image" value="{{ $blog->image }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="topic">Topic</label>
                                    <input type="text" class="form-control" id="" name="topic" value="{{ $blog->topic }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="post">Post</label>
                                    <br>
                                    <textarea name="post" id="post" cols="90" rows="10" value="{{ $blog->post }}"></textarea>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="">Author</label>
                                    <input type="text" class="form-control" id="" name="author" value="{{ $blog->author }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="writtendate">Dated</label>
                                    <input type="Date" class="form-control" id="dob" name="writtendate" value="{{ $blog->writtendate }}">

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

{{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. --}}

