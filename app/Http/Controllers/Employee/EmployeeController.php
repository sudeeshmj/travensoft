<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\WeeklyUpdate;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $weeklyUpdates = WeeklyUpdate::where('user_id', $userId)->orderby('id', 'desc')->paginate(10);
        return view('employee.weekly_updates.index', compact('weeklyUpdates'));
    }
    public function create()
    {
        return view('employee.weekly_updates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'nullable',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:10240',
        ]);

        if (empty($request->input('content'))  && !$request->hasFile('file')) {

            return back()->withErrors(['content' => 'Please provide either content or upload a file.']);
        }

        $uploadedFilePath = null;
        if ($request->hasFile('file')) {

            $filePaths = config('app.file_paths');
            $file = $request->file('file');
            $uploadFolderName = $filePaths["WEEKLY_UPDATES"];
            $uploadedFilePath = $this->uploadFile($file, $uploadFolderName);
        }
        $content = $request->input('content');
        $cleanedContent = trim(strip_tags($content));
        $newRow = [
            'department_id' => Auth::user()->department_id,
            'user_id' => Auth::user()->id,
            'content' =>  empty($cleanedContent) ? null : $content,
            'file' => $uploadedFilePath
        ];

        try {
            WeeklyUpdate::create($newRow);
            return redirect()->route('weekly-update.index')->with('success', 'Weekly update added successfully');
        } catch (Exception $e) {

            return redirect()->route('weekly-update.index')->with('error', 'Failed to add new weekly update');
        }
    }

    public function show(int $id)
    {
        $weeklyUpdate = WeeklyUpdate::with('user:id,name', 'department:id,name')->findOrFail($id);
        return response()->json($weeklyUpdate);
    }

    public function edit(int $id)
    {
        try {

            $weeklyUpdate = WeeklyUpdate::findOrFail($id);
            return view('employee.weekly_updates.update', compact('weeklyUpdate'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->route('weekly-update.index')->with('error', 'Record not found.');
        } catch (\Exception $e) {

            return redirect()->route('weekly-update.index')->with('error', 'An unexpected error occurred.');
        }
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'content' => 'nullable',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:10240',
        ]);

        if (empty($request->input('content'))  && !$request->hasFile('file') && !$request->input('old_file')) {

            return back()->withErrors(['content' => 'Please provide either content or upload a file.']);
        }

        try {

            $weeklyUpdate = WeeklyUpdate::findOrFail($id);
            $content = $request->input('content');
            $cleanedContent = trim(strip_tags($content));
            $updateRow = [
                'content' => empty($cleanedContent) ? null : $content,
            ];

            if ($request->hasFile('file')) {

                $filePaths = config('app.file_paths');
                $file = $request->file('file');
                $uploadFolderName = $filePaths["WEEKLY_UPDATES"];
                $uploadedFilePath = $this->uploadFile($file, $uploadFolderName);
                $updateRow['file'] = $uploadedFilePath;

                // Delete the old file if it exists
                if ($uploadedFilePath) {
                    if ($request->input('old_file') && file_exists(public_path($uploadFolderName . '/' . $request->input('old_file')))) {
                        unlink(public_path($uploadFolderName . '/' . $request->input('old_file')));
                    }
                }
            }

            $weeklyUpdate->update($updateRow);

            return redirect()->route('weekly-update.index')->with('success', 'Weekly update updated successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('weekly-update.index')->with('error', 'Record not found');
        } catch (\Exception $e) {

            return redirect()->route('weekly-update.index')->with('error', 'An error occurred while updating the weekly update');
        }
    }


    public function destroy(int $id)
    {
        try {

            $weeklyUpdate = WeeklyUpdate::findOrFail($id);

            //delete file

            $file =  $weeklyUpdate->file;
            $filePaths = config('app.file_paths.WEEKLY_UPDATES');
            if ($file && file_exists(public_path($filePaths . '/' . $file))) {
                unlink(public_path($filePaths . '/' . $file));
            }
            $weeklyUpdate->delete();

            return redirect()->route('weekly-update.index')->with('success', 'Weekly update deleted successfully');
        } catch (ModelNotFoundException $e) {

            return redirect()->route('weekly-update.index')->with('error', 'Weekly update not found');
        } catch (\Exception $e) {

            return redirect()->route('weekly-update.index')->with('error', 'An error occurred while deleting the Weekly update');
        }
    }


    private function uploadFile($file, $folder)
    {
        try {
            $extension = $file->extension();
            $fileName = time() . '_' . Auth::user()->id . '.' . $extension;
            $file->move(public_path($folder), $fileName);

            return $fileName;
        } catch (\Exception $e) {

            return false;
        }
    }
}
