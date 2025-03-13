<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a new assignment notification for students
     */
    public function notifyNewAssignment(Assignment $assignment): void
    {
        $students = User::where('role', 'student')
            ->where('created_by', $assignment->teacher_id)
            ->get();

        foreach ($students as $student) {
            Notification::create([
                'title' => 'New Assignment',
                'message' => "A new assignment '{$assignment->title}' has been posted. Due date: {$assignment->due_date->format('Y-m-d')}",
                'user_id' => $student->id,
                'assignment_id' => $assignment->id,
            ]);
        }
    }

    /**
     * Notify teacher about a new submission
     */
    public function notifySubmission(User $student, Assignment $assignment): void
    {
        Notification::create([
            'title' => 'New Submission',
            'message' => "Student {$student->name} has submitted an assignment for '{$assignment->title}'",
            'user_id' => $assignment->teacher_id,
            'assignment_id' => $assignment->id,
        ]);
    }

    /**
     * Notify student about a graded submission
     */
    public function notifyGraded(User $student, Assignment $assignment, int $grade): void
    {
        Notification::create([
            'title' => 'Assignment Graded',
            'message' => "Your submission for '{$assignment->title}' has been graded. Grade: {$grade}",
            'user_id' => $student->id,
            'assignment_id' => $assignment->id,
        ]);
    }
}