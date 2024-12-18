<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments  = Department::orderby('name')->get();
        return view('admin.departments.index', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_name' => 'required|string|max:250',
        ]);

        try {
            Department::create([
                'name' => $request->department_name,
            ]);

            return redirect()->route('department.index')->with('success', 'Department added successfully');
        } catch (Exception $e) {

            return redirect()->route('department.index')->with('error', 'Failed to add new department');
        }
    }

    public function update(Request $request, int $id)
    {

        $request->validate([
            'department_name' => 'required|string|max:250',
            'department_status' => 'required|boolean',
        ]);

        try {

            $department = Department::findOrFail($id);
            $department->update([
                'name' => $request->department_name,
                'status' => $request->department_status,
            ]);
            return redirect()->route('department.index')->with('success', 'Department updated successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('department.index')->with('error', 'Department not found');
        } catch (\Exception $e) {

            return redirect()->route('department.index')->with('error', 'An error occurred while updating the department');
        }
    }

    public function destroy(int $id)
    {
        try {

            $department = Department::findOrFail($id);
            $department->delete();
            return redirect()->route('department.index')->with('success', 'Department deleted successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('department.index')->with('error', 'Department not found');
        } catch (\Exception $e) {

            return redirect()->route('department.index')->with('error', 'An error occurred while deleting the department');
        }
    }
}
