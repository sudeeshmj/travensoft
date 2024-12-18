@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-md-12">
                <div id="response_message"></div>
                <div class="card">
                    <div class="card-header text-center">
                        <h5><span class="card-title">Weekly Updates</span></h5>
                    </div>
                    <div class="card-body">

                        <div class="search-container d-flex align-items-center mb-3">
                            <strong class="me-2">Employee:</strong>

                            <select id ="search_emp" name="empId" id="employee"
                                class="form-control form-select-sm  w-auto">
                                <option value="">--All--</option>

                                @foreach ($employees as $employee)
                                    <option {{ $empId == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">
                                        {{ $employee->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <table class="table table-sm table-striped table-bordered hover">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;">#</th>
                                    <th scope="col" style="width: 20%;">Employee Name</th>
                                    <th scope="col" style="width: 45%;">Note</th>
                                    <th scope="col" style="width: 15%;">Created on</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @forelse ($weeklyUpdates as $index => $weeklyUpdate)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $index + 1 + ($weeklyUpdates->currentPage() - 1) * $weeklyUpdates->perPage() }}
                                        </td>
                                        <td>{{ $weeklyUpdate->user->name }}</td>
                                        <td class="align-middle">
                                            @if ($weeklyUpdate->content && $weeklyUpdate->file)
                                                {{ Str::limit(strip_tags($weeklyUpdate->content), 100) }}<br>
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
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
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
    @include('employee.weekly_updates.view')
    <script>
        $(document).ready(function() {
            $('#search_emp').on('change', function() {
                const empId = $(this).val();
                const url = "{{ route('department.weekly-update.index', '') }}/" + empId;
                window.location.href = url;
            });
        });
    </script>
@endsection
