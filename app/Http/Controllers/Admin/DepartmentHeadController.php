<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Exception;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentHeadController extends Controller
{
    public function index()
    {
        $departments  = Department::where('status','1')->orderby('name')->get();
        $departmentHeads  = User::with('department')->where('role', 2)->orderby('id', 'desc')->get();

        return view('admin.department_heads.index', compact('departments', 'departmentHeads'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|integer',
            'employee_name' => 'required|string|max:250',
            'email' => 'required|string|email|max:250|unique:users,email',
            'password' => 'required|string',
        ]);

        try {
            User::create([
                'name' => $request->employee_name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 2,
                'department_id' => $request->department,
            ]);

            return redirect()->route('department.head.index')->with('success', 'Department head added successfully');
        } catch (Exception $e) {

            return redirect()->route('department.head.index')->with('error', 'Failed to add new department head');
        }
    }

    public function edit(int $id)
    {

        $departmentHead = User::findOrFail($id);
        return response()->json($departmentHead);
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'department' => 'required|integer',
            'employee_name' => 'required|string|max:250',
            'email' => 'required|string|email|max:250',

        ]);

        try {

            $departmentHead = User::findOrFail($id);

            $departmentHead->update([
                'name' => $request->employee_name,
                'email' => $request->email,
                'department_id' => $request->department,
            ]);

            return redirect()->route('department.head.index')->with('success', 'Department head details updated successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('department.head.index')->with('error', 'Department head not found');
        } catch (\Exception $e) {

            return redirect()->route('department.head.index')->with('error', 'An error occurred while updating the department head');
        }
    }

    public function destroy(int $id)
    {
        try {

            $departmentHead = User::findOrFail($id);
            $departmentHead->delete();
            return redirect()->route('department.head.index')->with('success', 'Department Head deleted successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('department.head.index')->with('error', 'Department Head not found');
        } catch (\Exception $e) {

            return redirect()->route('department.head.index')->with('error', 'An error occurred while deleting the department head');
        }
    }
}
