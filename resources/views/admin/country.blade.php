@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Countries</h1>
                <a class="btn btn-primary" href="{{ route('admin.add-country') }}" >Add Country</a>
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
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if ($countries!=null)
                                @foreach ($countries as $country)
                                <tr class="">
                                    <td scope="row">{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.edit-country' ,$country->id) }}" class="text-info px-1">
                                            <i data-feather="edit"></i>
                                        </a>
                                        <a href="{{ route('admin.delete-country' ,$country->id) }}" class="text-danger px-1">
                                            <i data-feather="trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @elseif($countries == null)
                                <tr class="alert alert-danger">
                                    No Countries Found
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                {{ $countries->links() }}
            </div>

        </div>
    </div>
</div>


@endsection
