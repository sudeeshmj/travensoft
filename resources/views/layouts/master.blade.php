@extends('layouts.app')
@section('content')
    <main class="sb-nav-fixed">
        @include('partials.navbar')
        <div id="layoutSidenav">
            @include('partials.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('admincontent')
                </main>
            </div>
        </div>
    </main>

    {{-- 
    <main class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Navbar -->
            @include('partials.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('partials.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('admincontent')

            </div>
            <!-- /.content-wrapper -->
            @include('partials.footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </main> --}}
@endsection
