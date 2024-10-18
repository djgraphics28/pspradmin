<?php

namespace App\Http\Controllers\API;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
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
            return response()->json($validator->errors(), 400);
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

        return response()->json(['message' => 'You are now registered successfully'], 201);
    }

    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string', // This can be either email or student_number
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Attempt to find the student by either email or student_number
        $student = Student::where('email', $request->identifier)
                        ->orWhere('student_number', $request->identifier)
                        ->first();

        if (!$student || !password_verify($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $student->createToken('StudentToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }


    //logout
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'You have been successfully logged out.'], 200);
    }

    //profile
    public function profile(Request $request)
    {
        return response()->json($request->user(), 200);
    }

    //CATEGORIES
    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    //GET LESSON BY CATEGORY
    public function lessonsByCategory($category_id)
    {
        $lessons = Lesson::where('category_id', $category_id)->get();
        return response()->json($lessons, 200);
    }

    //GET LESSON BY ID
    public function lessonInfo($id)
    {
        $lesson = Lesson::find($id);
        return response()->json($lesson, 200);
    }

}
