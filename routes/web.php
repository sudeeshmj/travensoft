<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DepartmentHeadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Departmen\PharmaDepartmentController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.redirect', 'preventBackHistory'])->group(function () {

    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/do-register', [AuthController::class, 'handleRegistration'])->name('register.submit');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::prefix('admin')->middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('department.store');
    Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('departments/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');

    Route::get('/department-heads', [DepartmentHeadController::class, 'index'])->name('department.head.index');
    Route::post('/department-heads', [DepartmentHeadController::class, 'store'])->name('department.head.store');
    Route::get('department-heads/{id}', [DepartmentHeadController::class, 'edit'])->name('department.head.edit');
    Route::put('department-heads/{id}', [DepartmentHeadController::class, 'update'])->name('department.head.update');
    Route::delete('department-heads/{id}', [DepartmentHeadController::class, 'destroy'])->name('department.head.destroy');
});


Route::prefix('employee')->middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'employeedashboard'])->name('employee.dashboard');
    Route::get('/weekly-updates', [EmployeeController::class, 'index'])->name('weekly-update.index');
    Route::get('/weekly-updates/create', [EmployeeController::class, 'create'])->name('weekly-update.create');
    Route::post('/weekly-updates', [EmployeeController::class, 'store'])->name('weekly-update.store');
    Route::get('weekly-updates/{id}', [EmployeeController::class, 'show'])->name('weekly-update.view');
    Route::get('weekly-updates/edit/{id}', [EmployeeController::class, 'edit'])->name('weekly-update.edit');
    Route::put('weekly-updates/{id}', [EmployeeController::class, 'update'])->name('weekly-update.update');
    Route::delete('weekly-updates/{id}', [EmployeeController::class, 'destroy'])->name('weekly-update.destroy');
});

Route::prefix('department')->middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'departmentDashboard'])->name('department.dashboard');
    Route::get('/weekly-updates/{emp?}', [PharmaDepartmentController::class, 'index'])->name('department.weekly-update.index');
});
