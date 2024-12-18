@extends('layouts.master')
@section('admincontent')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center my-2">{{ auth()->user()->department->name }}</h5>
                    <div class="row mt-4    ">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <span class="card-title">Weekly Updates</span>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee Name</th>
                                                    <th>Updates</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($employees as $employee)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td>
                                                            <a
                                                                href="{{ route('department.weekly-update.index', $employee->id) }}">{{ $employee->weekly_updates_count }}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3" class="text-center">No records found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
