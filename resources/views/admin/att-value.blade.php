@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Attribute Values</h1>
                <a class="btn btn-primary" href="{{ route('admin.att-value') }}" >Add Values</a>
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
                                <th scope="col">Attribute</th>
                                <th scope="col">Attribute Value</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($att_values as $att_value)
                            <tr class="">
                                <td scope="row">{{ $att_value->id }}</td>
                                <td>{{ $att_value->name }}</td>
                                <td>{{ $att_value->value }}</td>
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
                {{ $att_values->links() }}
            </div>

        </div>
    </div>
</div>


@endsection
