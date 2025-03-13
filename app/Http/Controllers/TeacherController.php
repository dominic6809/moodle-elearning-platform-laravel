<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.teacher');
    }

    public function dashboard()
    {
        $students = auth()->user()->students()->count();
        $assignments = auth()->user()->assignments()->count();
        $pendingSubmissions = Submission::whereHas('assignment', function ($query) {

            $query->where('teacher_id', auth()->user()->id);
        })->whereNull('grade')->count();

        return view('teacher.dashboard', compact('students', 'assignments', 'pendingSubmissions'));
    }

    public function students()
    {
        $students = auth()->user()->students()->paginate(10);
        return view('teacher.students.index', compact('students'));
    }

    public function createStudent()
    {
        return view('teacher.students.create');
    }

    public function showStudent(Student $student)
    {
        return view('teacher.students.show', compact('student'));
    }

    public function storeStudent(StoreStudentRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $validated['teacher_id'] = auth()->user()->id;

        Student::create($validated);

        return redirect()->route('teacher.students')
            ->with('success', 'Student created successfully.');
    }

    public function submissions()
    {
        $submissions = Submission::whereHas('assignment', function ($query) {

            $query->where('teacher_id', auth()->user()->id);
        })->with(['student', 'assignment'])->latest()->paginate(10);

        return view('teacher.submissions.index', compact('submissions'));
    }

    public function showSubmission(Submission $submission)
    {
        return view('teacher.submissions.grade', compact('submission'));
    }

    public function gradeSubmission(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'required|string',
        ]);

        $submission->update($validated);

        return redirect()->route('teacher.submissions')
            ->with('success', 'Submission graded successfully.');
    }
}