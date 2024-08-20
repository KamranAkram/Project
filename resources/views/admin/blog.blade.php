@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Blogs</h1>
                <a class="btn btn-primary" href="{{ route('admin.write') }}" >Add Blog</a>
            </div>
            <div class="card-body">

                <div
                    class="table-responsive"
                >
                    <table
                        class="table"
                    >
                        <thead class="table-success text-center">
                            <tr>
                                <th scope="col">Sr #</th>
                                <th scope="col">Image</th>
                                <th scope="col">Topic</th>
                                <th scope="col">Author</th>
                                <th scope="col">Dated</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($blogs as $blog)
                            <tr class="">
                                <td scope="row">{{ $blog->id }}</td>
                                <td>{{ $blog->image }}</td>
                                <td>{{ $blog->topic }}</td>
                                <td>{{ $blog->author }}</td>
                                <td>{{ $blog->writtendate }}</td>
                                <td>
                                    <a href="#" class="text-info px-1">
										<i data-feather="edit"></i>
									</a>
									<a href="#" class="text-danger px-1">
										<i data-feather="trash"></i>
									</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection
