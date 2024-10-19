<?php

namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class InstructorController extends Controller
{
    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Attempt to find the instructor by either email or student_number
        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor || !password_verify($request->password, $instructor->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $instructor->createToken('InstructorToken')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $instructor ], 200);
    }

    //getProfile
    public function getProfile(Request $request)
    {
        $instructor = $request->user();

        return response()->json(['instructor' => $instructor], 200);
    }

    //updateProfile
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'string',
            'password' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $instructor = $request->user();

        if ($request->has('name')) {
            $instructor->name = $request->name;
        }

        if ($request->has('email')) {
            $instructor->email = $request->email;
        }

        if ($request->has('password')) {
            $instructor->password = bcrypt($request->password);
        }

        $instructor->save();

        return response()->json(['message' => 'Profile updated successfully', 'instructor' => $instructor], 200);
    }

    //changePassword
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $instructor = $request->user();

        if (!password_verify($request->current_password, $instructor->password)) {
            return response()->json(['message' => 'Invalid current password'], 401);
        }

        $instructor->password = bcrypt($request->new_password);
        $instructor->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    //logout
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'You have been successfully logged out.'], 200);
    }

    //getCategories
    public function categories(Request $request)
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories], 200);
    }

    //storeLesson
    public function storeLesson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'content' => $request->body,
            'instructor_id' => $request->user()->id,
        ]);
        //please breakdown request all

        return response()->json(['message' => 'Lesson created successfully', 'lesson' => $lesson], 201);
    }

    //getLessons
    public function getLessons(Request $request)
    {
        $lessons = Lesson::where('instructor_id', $request->user()->id)->get();

        return response()->json(['lessons' => $lessons], 200);
    }

    //getLesson
    public function getLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        return response()->json(['lesson' => $lesson], 200);
    }

    //updateLesson
    public function updateLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
            'category' => 'string',
            'body' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $lesson->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'content' => $request->body,
        ]);

        return response()->json(['message' => 'Lesson updated successfully', 'lesson' => $lesson], 200);
    }

    //deleteLesson
    public function deleteLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $lesson->delete();

        return response()->json(['message' => 'Lesson deleted successfully'], 200);
    }

    //storeQuizByLessonId
    public function storeQuizByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Create the quiz
        $quiz = Quiz::create([
            'lesson_id' => $lesson->id,
            // You can add other quiz-related fields if necessary
        ]);

        foreach ($request->questions as $questionData) {
            // Create the question associated with the quiz
            $question = $quiz->questions()->create([
                'question' => $questionData['question'],
            ]);

            // Create answers for the question
            foreach ($questionData['options'] as $option) {
                $question->answers()->create([
                    'answer_text' => $option,
                    'is_correct' => $option === $questionData['correct_answer'],
                ]);
            }
        }

        return response()->json(['message' => 'Quiz created successfully', 'quiz' => $quiz], 201);
    }

    //getQuizzesByLessonId
    public function getQuizzesByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $quizzes = Quiz::where('lesson_id', $lesson->id)->get();

        return response()->json(['quizzes' => $quizzes], 200);
    }

    //updateQuizByLessonId
    public function updateQuizByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return response()->json(['message' => 'Lesson not found'], 404);
        }

        $quiz = Quiz::where('lesson_id', $lesson->id)->first();

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update the quiz
        $quiz->update([
            // You can add other quiz-related fields if necessary
        ]);

        // Delete existing questions and answers
        $quiz->questions()->delete();

        foreach ($request->questions as $questionData) {
            // Create the question associated with the quiz
            $question = $quiz->questions()->create([
                'question' => $questionData['question'],
            ]);

            // Create answers for the question
            foreach ($questionData['options'] as $option) {
                $question->answers()->create([
                    'answer_text' => $option,
                    'is_correct' => $option === $questionData['correct_answer'],
                ]);
            }
        }

        return response()->json(['message' => 'Quiz updated successfully', 'quiz' => $quiz], 200);
    }

    //updatQuiz
    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
            'category' => 'string',
            'body' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'content' => $request->body,
        ]);

        return response()->json(['message' => 'Quiz updated successfully', 'quiz' => $quiz], 200);
    }

    //deleteQuiz
    public function deleteQuiz(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $quiz->delete();

        return response()->json(['message' => 'Quiz deleted successfully'], 200);
    }

    //getStudentListFromUserAnswerModel
    public function getStudentListFromUserAnswerModel(Request $request, $id)
    {
        $quiz = Quiz::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $studentList = $quiz->userAnswers()->with('student')->get();

        return response()->json(['student_list' => $studentList], 200);
    }

    //getUserAnswerInfoByStudentId
    public function getUserAnswerInfoByStudentId(Request $request, $id, $studentId)
    {
        $quiz = Quiz::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $userAnswer = $quiz->userAnswers()->where('student_id', $studentId)->first();

        if (!$userAnswer) {
            return response()->json(['message' => 'User answer not found'], 404);
        }

        return response()->json(['user_answer' => $userAnswer], 200);
    }



}
