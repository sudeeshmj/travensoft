@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div id="response_message"></div>
                <div class="card">
                    <div class="card-header">
                        <h5>
                            <span class="card-title">Weekly Updates</span>
                            <a class="btn btn-sm btn-success float-end" href="{{ route('weekly-update.create') }}">Add
                                New</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 45%;">Note</th>
                                    <th scope="col" style="width: 25%;">Created on</th>
                                    <th scope="col" style="width: 20%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($weeklyUpdates as   $index => $weeklyUpdate)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $index + 1 + ($weeklyUpdates->currentPage() - 1) * $weeklyUpdates->perPage() }}
                                        </td>
                                        <td class="align-middle">
                                            @if ($weeklyUpdate->content && $weeklyUpdate->file)
                                                {{ Str::limit(strip_tags($weeklyUpdate->content), 100) }}
                                                <br>
                                                <a href="{{ asset(config('app.file_paths.WEEKLY_UPDATES') . '/' . $weeklyUpdate->file) }}"
                                                    download>{{ $weeklyUpdate->file }}</a>
                                            @elseif($weeklyUpdate->content)
                                                {{ Str::limit(strip_tags($weeklyUpdate->content), 100) }}
                                            @elseif($weeklyUpdate->file)
                                                <a href="{{ asset(config('app.file_paths.WEEKLY_UPDATES') . '/' . $weeklyUpdate->file) }}"
                                                    download>{{ $weeklyUpdate->file }}</a>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $weeklyUpdate->created_at->format('d M Y') }}</td>
                                        <td class="align-middle">
                                            <button class="btn btn-info btn-sm view-btn" data-bs-toggle="modal"
                                                data-bs-target="#weeklyUpdateViewModal"
                                                data-url = "{{ route('weekly-update.view', $weeklyUpdate->id) }}"
                                                data-downlodlink = "{{ asset(config('app.file_paths.WEEKLY_UPDATES')) }}"
                                                data-id="{{ $weeklyUpdate->id }}">View</button>
                                            <a class="btn btn-warning btn-sm edit-btn"
                                                href="{{ route('weekly-update.edit', $weeklyUpdate->id) }}">Edit</a>
                                            <button class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $weeklyUpdate->id }}" data-bs-toggle="modal"
                                                data-bs-target="#WeeklyUpdateDeleteModal"
                                                id="weekly_update_delete_btn">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data found</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        {!! $weeklyUpdates->withQueryString()->links('pagination::bootstrap-5') !!}
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
    @include('employee.weekly_updates.view')
    @include('employee.weekly_updates.delete')
@endsection
