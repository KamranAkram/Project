@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Categories</h1>
                <a class="btn btn-primary" href="{{ route('admin.add-category') }}" >Add Category</a>
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
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($categories as $category)
                            <tr class="">
                                <td scope="row">{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
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
            <div class="card-footer">
                {{ $categories->links() }}
            </div>

        </div>
    </div>
</div>


@endsection
