@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-8">
                <div id="response_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <span class="card-title">Departments</span>
                            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal"
                                data-bs-target="#departmentModal">Add New</button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($departments as $department)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $department->name }}</td>
                                        <td class="align-middle">{{ $department->status_text }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $department->id }}"
                                                data-name="{{ $department->name }}" data-status="{{ $department->status }}"
                                                data-bs-toggle="modal" data-bs-target="#departmentEditModal"
                                                id="department_edit_btn">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $department->id }}"
                                                data-bs-toggle="modal" id="department_delete_btn"
                                                data-bs-target="#departmentDeleteModal">Delete</button>


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}")
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}")
        </script>
    @endif
    @include('admin.departments.create')
    @include('admin.departments.update')
    @include('admin.departments.delete')
@endsection
