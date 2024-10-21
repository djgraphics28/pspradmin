<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Category;
use App\Models\StudentQuiz;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Concerns\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\API\LessonResource;
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

        return $this->success(['token' => $token, 'user' => new StudentProfileResource($student)], 'Login successful', 200);
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
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'contact_number' => 'string',
            'email' => 'required|email',
            'student_number' => 'required',
        ]);

        $student = $request->user();

        $student->update($request->only(['first_name', 'middle_name', 'last_name', 'contact_number', 'email', 'student_number']));

        return $this->success([], 'Profile updated successfully', 200);
    }

    //updatePassword
    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:6',
        ]);

        $student = $request->user();

        return $this->success($student, 'Password updated successfully', 200);

        if (!password_verify($validatedData['currentPassword'], $student->password)) {
            return $this->error([], 'Invalid current password', 400);
        }

        $student->password = bcrypt($validatedData['newPassword']);
        $student->save();

        return $this->success([], 'Password updated successfully', 200);
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
        return $this->success(LessonResource::collection($lessons), 'Lessons retrieved successfully', 200);
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

        // Load quizzes with their questions and choices
        $quizzes = Quiz::with(['questions.choices'])
            ->where('lesson_id', $id)
            ->get();

        // Shuffle choices for each question in the quizzes
        foreach ($quizzes as $quiz) {
            foreach ($quiz->questions as $question) {
                // Shuffle the choices
                $question->choices = $question->choices->shuffle();
            }
        }

        // Return the quizzes related to the lesson
        return $this->success($quizzes, 'Quizzes retrieved successfully', 200);
    }


    public function takeQuiz(Request $request, $quizId): JsonResponse
    {
        $student = $request->user();
        // Validate incoming request
        $validatedData = $request->validate([
            'score' => 'required|integer',
            'total_questions' => 'required|integer',
            'time_taken' => 'required|integer',
            'questionAnswers' => 'required',
        ]);

        // Extract validated data
        $score = $validatedData['score'];
        $totalQuestions = $validatedData['total_questions'];
        $timeTaken = $validatedData['time_taken'];

        // Calculate percentage score
        $percentageScore = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

        // Determine status based on percentage score (example logic)
        $status = ($percentageScore >= 60) ? 'passed' : 'failed';

        // Create a new student quiz record
        $studentQuiz = StudentQuiz::create([
            'student_id' => $student->id, // Use validated student_id
            'quiz_id' => $quizId,
            'quiz_data' => json_encode($request->questionAnswers),
            'score' => $score, // Use the extracted score
            'total_questions' => $totalQuestions, // Use the extracted total_questions
            'time_taken' => $timeTaken,
            'status' => $status, // Use the calculated status
            'remarks' => ($status === 'passed') ? 'Congratulations! You passed.' : 'You did not pass. Please try again.', // Set remarks based on status
        ]);

        // Return success response
        return response()->json([
            'score' => $score,
            'total_questions' => $totalQuestions,
            'percentage_score' => $percentageScore,
            'status' => $status,
            'remarks' => $studentQuiz->remarks, // Return the remarks from the created record
        ], 200);
    }
}
