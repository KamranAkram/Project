@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Categories</h1>
                <a class="btn btn-primary" href="{{ route('admin.add-subcat') }}" >Add SubCategory</a>
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
                                <th scope="col">Category</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($subCategories as $value)
                            <tr class="">
                                <td scope="row">{{ $value->id }}</td>
                                <td>{{ $value->categoryName }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->slug }}</td>
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
                {{ $subCategories->links() }}
            </div>
        </div>
    </div>
</div>


@endsection
