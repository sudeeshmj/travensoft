@extends('layouts.app')
@section('content')
    <main class="login-form vh-100">
        <div class="container">
            <div class="row  align-items-center justify-content-center">
                
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="mb-4">
                                <h3>Travansoft Pharma</h3>
                                <p class="mb-4 text-muted">Begin your journey in the pharmaceutical world</p>
                            </div>
                            <form method="POST" action="{{ route('register.submit') }}">
                                @csrf

                                <div id="response_message">
                                    @if (session()->has('success'))
                                        <div class="alert alert-success">
                                            Registration Successfull. Please  <a href="{{ route('login') }}">Login</a> 
                                        </div>
                                    @endif
                
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                                    @endif
                                </div>
                                <div class="form-group mb-4">
                                    <label for="employee_name">Employee Name</label>
                                    <input type="text" required placeholder="Name" id="employee_name" class="form-control"
                                        name="employee_name" value="{{ old('employee_name') }}">
                                    @if ($errors->has('employee_name'))
                                        <span class="text-danger fs-14">{{ $errors->first('employee_name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <label for="employee_name">Department</label>
                                   <select name="department" required id="department" class="form-control">
                                    <option value="">select</option>
                                    @foreach ($departments as $department)
                                    <option  {{ old('department') == $department->id ? 'selected':'' }} value="{{ $department->id }}">{{ $department->name }}</option>
                                        
                                    @endforeach
                                   </select>
                                    @if ($errors->has('department'))
                                        <span class="text-danger fs-14">{{ $errors->first('department') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" required  placeholder="Email" id="email" class="form-control"
                                        name="email"  value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger fs-14">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group  mb-4 ">
                                    <label for="password">Password</label>
                                    <input type="password" required placeholder="Password" id="password"
                                        class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger fs-14">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-block btn-primary login-btn">Register</button>
                                </div>

                                <div class="text-center my-3">
                                    <span><a href="{{ route('login') }}" class="text-muted">Already have an account</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <img src="{{ asset('assets/image/registerlogo.jpg') }}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </main>
@endsection
