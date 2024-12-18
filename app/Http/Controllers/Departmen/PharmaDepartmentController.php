<?php

namespace App\Http\Controllers\Departmen;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WeeklyUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmaDepartmentController extends Controller
{
    public function index($empId = null)
    {
        $departmentId = Auth::user()->department_id;

        $employees = User::where('department_id', $departmentId)
            ->where('role', 3)
            ->orderby('name', 'asc')
            ->get();

        $query = WeeklyUpdate::with('user')
            ->where('department_id', $departmentId);

        if ($empId) {
            $query->where('user_id', $empId);
        }
        $weeklyUpdates =    $query->orderby('id', 'desc')
            ->paginate(10);

        return view('department.weekly_updates.index', compact('weeklyUpdates', 'employees', 'empId'));
    }
}
