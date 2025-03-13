<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitAssignmentRequest;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function index(Request $request)
    {
        // Ensure only teachers can access this page
        if (!auth()->user()->isTeacher()) {
            abort(403);
        }

        // Fetch students that belong to the authenticated teacher
        $students = \App\Models\Student::where('teacher_id', auth()->id())->get();

        // Fetch assignments related to the teacher
        $assignments = Assignment::where('teacher_id', auth()->id())->get();

        // Fetch submissions with optional filters
        $query = Submission::query();

        if ($request->filled('student')) {
            $query->where('student_id', $request->student);
        }

        if ($request->filled('assignment')) {
            $query->where('assignment_id', $request->assignment);
        }

        $submissions = $query->get();

        // Debugging - Uncomment this line to check if students are being fetched
        // dd($students);

        return view('teacher.submissions.index', compact('students', 'assignments', 'submissions'));
    }


    public function create(Assignment $assignment)
    {
        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', auth()->guard('student')->id())
            ->first();
            
        if ($submission) {
            return redirect()->route('student.submission.edit', $submission);
        }
        
        return view('student.submissions.create', compact('assignment'));
    }

    public function store(SubmitAssignmentRequest $request, Assignment $assignment)
    {
        $validated = $request->validated();
        $validated['assignment_id'] = $assignment->id;
        $validated['student_id'] = auth()->guard('student')->id();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('submissions', 'public');
            $validated['file_path'] = $path;
        }

        Submission::create($validated);

        return redirect()->route('student.assignments')
            ->with('success', 'Assignment submitted successfully.');
    }

    public function edit(Submission $submission)
    {
        if ($submission->student_id !== auth()->guard('student')->id()) {
            abort(403);
        }
        
        $assignment = $submission->assignment;
        return view('student.submissions.edit', compact('submission', 'assignment'));
    }

    public function update(SubmitAssignmentRequest $request, Submission $submission)
    {
        if ($submission->student_id !== auth()->guard('student')->id()) {
            abort(403);
        }
        
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($submission->file_path) {
                Storage::disk('public')->delete($submission->file_path);
            }
            
            $path = $request->file('file')->store('submissions', 'public');
            $validated['file_path'] = $path;
        }

        $submission->update($validated);

        return redirect()->route('student.assignments')
            ->with('success', 'Submission updated successfully.');
    }
}