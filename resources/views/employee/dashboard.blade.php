@extends('layouts.master')
@section('admincontent')
    <div class="container-fluid px-4">
        <h3 class="mt-4">Dashboard</h3>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card dashboard-card1 text-white mb-4">
                    <div class="card-body d-flex justify-content-between">Weekly Updates
                        <div>{{ $weeklyUpdateCount }}</div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('weekly-update.index') }}">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection