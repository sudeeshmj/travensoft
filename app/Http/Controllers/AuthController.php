<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Department;
use App\Models\User;
use App\Models\WeeklyUpdate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(LoginRequest $request)
    {

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->role == 2) {
                return redirect()->route('department.dashboard');
            } else {
                return redirect()->route('employee.dashboard');
            }
        } else {
            return redirect()->route('login')->with('message', 'Email or Password is Invalid.');
        }
    }

    public function register()
    {
        $departments = Department::where('status', '1')->orderby('name')->get();
        return view('auth.register', compact('departments'));
    }

    public function handleRegistration(RegisterRequest $request)
    {

        $credentials = $request->validated();

        try {

            User::create([
                'name' => $request->employee_name,
                'email' => $request->email,
                'password' =>  bcrypt($request->password),
                'department_id' => $request->department,
                'role' => 3
            ]);
            return redirect()->route('register')->with('success', 'Registration successful');
        } catch (Exception $e) {

            return redirect()->route('register')->with('error', 'Registration failed.');
        }
    }


    public function admindashboard()
    {
        $departmentCount = Department::count();
        $departmentHeadCount = User::where('role', 2)->count();
        return view('admin.dashboard', compact('departmentCount', 'departmentHeadCount'));
    }
    public function departmentdashboard()
    {
        $employees = User::withCount('weeklyUpdates')
            ->where('department_id', Auth::user()->department_id)
            ->where('role', 3)
            ->orderby('name', 'asc')
            ->get();

        return view('department.dashboard', compact('employees'));
    }
    public function employeedashboard()
    {
        $weeklyUpdateCount = WeeklyUpdate::where('user_id', Auth::user()->id)->count();
        return view('employee.dashboard', compact('weeklyUpdateCount'));
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
