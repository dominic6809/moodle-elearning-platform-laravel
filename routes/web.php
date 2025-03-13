<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes (for teachers only)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Teacher routes
Route::middleware(['auth', 'is.teacher'])->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');

    // Student management
    Route::get('/students', [TeacherController::class, 'students'])->name('teacher.students');
    Route::get('/students/create', [TeacherController::class, 'createStudent'])->name('teacher.students.create');
    Route::post('/students', [TeacherController::class, 'storeStudent'])->name('teacher.students.store');
    Route::get('/students/{student}', [TeacherController::class, 'showStudent'])->name('teacher.students.show');
    Route::get('/students/{student}/edit', [TeacherController::class, 'editStudent'])->name('teacher.students.edit');

    // Assignment management
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit'); // <-- Add this route
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update'); // <-- And this one
    Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');


    // Submission management
    Route::get('/submissions', [TeacherController::class, 'submissions'])->name('teacher.submissions');
    Route::get('/submissions/{submission}', [TeacherController::class, 'showSubmission'])->name('teacher.submission.show');
    Route::post('/submissions/{submission}/grade', [TeacherController::class, 'gradeSubmission'])->name('teacher.submission.grade');
});

// Student routes
Route::middleware(['auth:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    // Assignment viewing
    Route::get('/assignments', [StudentController::class, 'assignments'])->name('student.assignments');
    Route::get('/assignments/{assignment}', [StudentController::class, 'showAssignment'])->name('student.assignment.show');

    // Submissions
    Route::get('/assignments/{assignment}/submit', [SubmissionController::class, 'create'])->name('student.submission.create');
    Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('student.submission.store');
    Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'edit'])->name('student.submission.edit');
    Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('student.submission.update');

    // Notifications
    Route::get('/notifications', [StudentController::class, 'notifications'])->name('student.notifications');
    Route::post('/notifications/{notification}/read', [StudentController::class, 'markNotificationRead'])->name('student.notification.read');
});
