<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Notification;
use App\Models\Submission;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function dashboard()
    {
        $assignments = Assignment::where('teacher_id', auth()->guard('student')->user()->teacher_id)
            ->latest()
            ->take(5)
            ->get();
            
        $notifications = Notification::where('student_id', auth()->guard('student')->id())
            ->where('read', false)
            ->count();
            

        $submissions = Submission::where('student_id', auth()->guard('student')->id())
            ->with('assignment')
            ->latest()
            ->take(5)
            ->get();
            
        return view('student.dashboard', compact('assignments', 'notifications', 'submissions'));
    }

    public function assignments()
    {
        $assignments = Assignment::where('teacher_id', auth()->guard('student')->user()->teacher_id)
            ->latest()
            ->paginate(10);
            
        return view('student.assignments.index', compact('assignments'));
    }

    public function showAssignment(Assignment $assignment)
    {
        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('student_id', auth()->guard('student')->id())
            ->first();
            
        // Mark notification as read if exists
        Notification::where('assignment_id', $assignment->id)
            ->where('student_id', auth()->guard('student')->id())
            ->update(['read' => true]);
            
        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    public function notifications()
    {
        $notifications = Notification::where('student_id', auth()->guard('student')->id())
            ->with('assignment')
            ->latest()
            ->paginate(10);
            
        return view('student.notifications.index', compact('notifications'));
    }

    public function markNotificationRead(Notification $notification)
    {
        $notification->update(['read' => true]);
        return redirect()->route('student.assignment.show', $notification->assignment_id);
    }
}