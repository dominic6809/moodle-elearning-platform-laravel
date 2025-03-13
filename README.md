# Online Learning Platform

## Overview
This is a minimal **Online Learning Platform** built with the **Laravel Framework**. It allows a **Teacher** to create **Student accounts**, upload assignments, notify students, and grade submitted work. **Students can only log in with credentials provided by the Teacher** to view and submit assignments.

## Features

### **Teacher Functionalities**
- Register on the platform.
- Create student accounts (students cannot self-register).
- Upload assignments.
- Send notifications to students regarding assignments.
- View submitted assignments.
- Grade and comment on assignments.

### **Student Functionalities**
- Log in using credentials created by the teacher.
- View assigned coursework.
- Submit completed assignments.

### **Authentication System**
- Only teachers can register.
- Students can only log in using credentials created by the teacher.
- No explicit roles are assigned in the authentication process.

---

## **Project Structure**

```
/online-learning-platform
│── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── TeacherController.php
│   │   │   ├── StudentController.php
│   │   │   ├── AssignmentController.php
│   │   │   ├── SubmissionController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Assignment.php
│   │   ├── Submission.php
│   ├── Notifications/
│   │   ├── AssignmentNotification.php
│── database/
│   ├── migrations/
│   │   ├── 2024_xx_xx_create_users_table.php
│   │   ├── 2024_xx_xx_create_assignments_table.php
│   │   ├── 2024_xx_xx_create_submissions_table.php
│   ├── seeders/
│── routes/
│   ├── web.php
│── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   ├── teacher/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── create_student.blade.php
│   │   │   ├── upload_assignment.blade.php
│   │   │   ├── view_submissions.blade.php
│   │   │   ├── grade_submission.blade.php
│   │   ├── student/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── view_assignment.blade.php
│   │   │   ├── submit_assignment.blade.php
│── public/
│── .env
│── composer.json
│── package.json
│── README.md
```

---

## **Installation Guide**

### **Prerequisites**
Ensure you have the following installed on your system:
- PHP (>=8.0)
- Composer
- Laravel
- MySQL or PostgreSQL (configured in the `.env` file)
- Node.js & NPM (for frontend assets)

### **Setup Instructions**

1. **Clone the repository:**
   ```sh
   git clone https://github.com/your-repo/e-learning-platform.git
   cd e-learning-platform
   ```
2. **Install dependencies:**
   ```sh
   composer install
   npm install
   ```
3. **Set up the environment file:**
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
4. **Configure your database** in `.env` file and run migrations:
   ```sh
   php artisan migrate --seed
   ```
5. **Start the development server:**
   ```sh
   php artisan serve
   ```
6. **Access the platform in your browser:**
   ```
   http://127.0.0.1:8000
   ```

---

## **Usage**

### **Teacher Workflow:**
1. Register and log in to the platform.
2. Create student accounts.
3. Upload assignments.
4. Send notifications to students.
5. View submitted assignments.
6. Grade and provide feedback.

### **Student Workflow:**
1. Log in using credentials provided by the teacher.
2. View available assignments.
3. Submit completed assignments.
4. Wait for grading and feedback from the teacher.

---

## **License**
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## **Contributing**
If you’d like to contribute, please create a pull request or report issues via the GitHub repository.

Happy coding! 🚀

