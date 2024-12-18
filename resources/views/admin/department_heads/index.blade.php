@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div id="response_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <span class="card-title">Department Heads</span>
                            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal"
                                data-bs-target="#departmentHeadModal">Add New</button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($departmentHeads as $departmentHead)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $departmentHead->department->name }}</td>
                                        <td class="align-middle">{{ $departmentHead->name }}</td>
                                        <td class="align-middle">{{ $departmentHead->email }}</td>

                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-sm edit-btn"
                                                data-id="{{ $departmentHead->id }}" data-bs-toggle="modal"
                                                data-url = "{{ route('department.head.edit', $departmentHead->id) }}"
                                                data-bs-target="#departmentHeadEditModal"
                                                id="department_head_edit_btn">Edit</button>
                                            <button class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $departmentHead->id }}" data-bs-toggle="modal"
                                                id="department_head_delete_btn" data-bs-target="#departmentHeadDeleteModal">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
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
    @include('admin.department_heads.delete')
    @include('admin.department_heads.create')
    @include('admin.department_heads.update')
@endsection
