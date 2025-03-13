<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Models\Assignment;
use App\Models\Notification;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.teacher');
    }

    public function index()
    {
        $assignments = auth()->user()->assignments()->latest()->paginate(10);
        return view('teacher.assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('teacher.assignments.create');
    }

    public function store(StoreAssignmentRequest $request)
    {
        $validated = $request->validated();
        $validated['teacher_id'] = auth()->id();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('assignments', 'public');
            $validated['file_path'] = $path;
        }

        $assignment = Assignment::create($validated);

        // Create notifications for all students
        $students = auth()->user()->students;
        
        foreach ($students as $student) {
            Notification::create([
                'student_id' => $student->id,
                'assignment_id' => $assignment->id,
                'title' => 'New Assignment: ' . $assignment->title,
                'message' => 'You have a new assignment titled ' . $assignment->title . ' due on ' . $assignment->due_date->format('F d, Y'),
            ]);
        }

        return redirect()->route('assignments.index')
            ->with('success', 'Assignment created successfully.');
    }

    public function show(Assignment $assignment)
    {
        $submissions = $assignment->submissions()->with('student')->get();
        return view('teacher.assignments.show', compact('assignment', 'submissions'));
    }

    public function edit(Assignment $assignment)
    {
        return view('teacher.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($assignment->file_path) {
                Storage::disk('public')->delete($assignment->file_path);
            }

            // Store new file
            $validated['file_path'] = $request->file('file')->store('assignments', 'public');
        }

        $assignment->update($validated);

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
{
    // Delete file if exists
    if ($assignment->file_path) {
        Storage::disk('public')->delete($assignment->file_path);
    }

    // Delete the assignment
    $assignment->delete();

    return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully.');
}


}