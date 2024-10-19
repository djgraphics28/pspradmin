<?php

namespace App\Http\Controllers\API;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concerns\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\API\StudentProfileResource;

class StudentController extends Controller
{
    use HttpResponses; // Use the HttpResponses trait

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_number' => 'required|string|unique:students',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:students',
            'password' => 'required|string|min:6',
            'contact_number' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation errors occurred', 400);
        }

        $student = Student::create([
            'student_number' => $request->student_number,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact_number' => $request->contact_number,
            'is_active' => $request->is_active ?? true,
        ]);

        return $this->success([], 'You are now registered successfully', 201);
    }

    // Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string', // This can be either email or student_number
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation errors occurred', 400);
        }

        // Attempt to find the student by either email or student_number
        $student = Student::where('email', $request->identifier)
                        ->orWhere('student_number', $request->identifier)
                        ->first();

        if (!$student || !password_verify($request->password, $student->password)) {
            return $this->unauthorized('Invalid credentials');
        }

        $token = $student->createToken('StudentToken')->plainTextToken;

        return $this->success(['token' => $token, 'user' => New StudentProfileResource($student)], 'Login successful', 200);
    }

    // Logout
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return $this->success([], 'You have been successfully logged out.', 200);
    }

    // Profile
    public function profile(Request $request)
    {
        return $this->success($request->user(), 'Profile retrieved successfully', 200);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string',
            'middle_name' => 'nullable|string',
            'last_name' => 'string',
            'contact_number' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation errors occurred', 400);
        }

        $student = $request->user();
        $student->update($request->all());

        return $this->success([], 'Profile updated successfully', 200);
    }

    // Change Password
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Validation errors occurred', 400);
        }

        $student = $request->user();

        if (!password_verify($request->current_password, $student->password)) {
            return $this->unauthorized('Invalid current password');
        }

        $student->password = bcrypt($request->new_password);
        $student->save();

        return $this->success([], 'Password changed successfully', 200);
    }

    // Categories
    public function categories()
    {
        $categories = Category::all();
        return $this->success($categories, 'Categories retrieved successfully', 200);
    }

    // Get Lessons by Category
    public function lessonsByCategory($category_id)
    {
        $lessons = Lesson::where('category_id', $category_id)->get();
        return $this->success($lessons, 'Lessons retrieved successfully', 200);
    }

    // Get Lesson by ID
    public function lessonInfo($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->notFound('Lesson not found');
        }
        return $this->success($lesson, 'Lesson retrieved successfully', 200);
    }

    // Get Quizzes by Lesson ID
    public function getQuizzesByLessonId($id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return $this->notFound('Lesson not found');
        }
        return $this->success($lesson->quizzes, 'Quizzes retrieved successfully', 200);
    }
}
