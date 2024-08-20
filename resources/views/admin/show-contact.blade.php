@extends('admin.admin-layouts.layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-primary pt-2" style="font-weight: bold">Contact Details</h1>
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
                                <th scope="col">Email</th>
                                <th scope="col">Message</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($contacts as $contact)
                            <tr class="">
                                <td scope="row">{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->message }}</td>
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
