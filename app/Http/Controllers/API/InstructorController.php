<?php
namespace App\Http\Controllers\API;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Concerns\Traits\HttpResponses;

class InstructorController extends Controller
{
    use HttpResponses; // Use your HttpResponses trait

    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        // Attempt to find the instructor by email
        $instructor = Instructor::where('email', $request->email)->first();

        if (!$instructor || !password_verify($request->password, $instructor->password)) {
            return $this->error(['message' => 'Invalid credentials'], 401);
        }

        $token = $instructor->createToken('InstructorToken')->plainTextToken;

        return $this->success(['token' => $token, 'user' => $instructor], 200);
    }

    //getProfile
    public function getProfile(Request $request)
    {
        $instructor = $request->user();
        return $this->success(['instructor' => $instructor], 200);
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
            return $this->error($validator->errors(), 400);
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

        return $this->success(['message' => 'Profile updated successfully', 'instructor' => $instructor], 200);
    }

    //changePassword
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        $instructor = $request->user();

        if (!password_verify($request->current_password, $instructor->password)) {
            return $this->error(['message' => 'Invalid current password'], 401);
        }

        $instructor->password = bcrypt($request->new_password);
        $instructor->save();

        return $this->success(['message' => 'Password changed successfully'], 200);
    }

    //logout
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the request
        $request->user()->currentAccessToken()->delete();

        return $this->success(['message' => 'You have been successfully logged out.'], 200);
    }

    //getCategories
    public function categories(Request $request)
    {
        $categories = Category::all();
        return $this->success(['categories' => $categories], 200);
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
            return $this->error($validator->errors(), 400);
        }

        $lesson = Lesson::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'content' => $request->body,
            'instructor_id' => $request->user()->id,
        ]);

        return $this->success(['message' => 'Lesson created successfully', 'lesson' => $lesson], 201);
    }

    //getLessons
    public function getLessons(Request $request)
    {
        $lessons = Lesson::where('instructor_id', $request->user()->id)->get();
        return $this->success(['lessons' => $lessons], 200);
    }

    //getLesson
    public function getLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        return $this->success(['lesson' => $lesson], 200);
    }

    //updateLesson
    public function updateLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'description' => 'string',
            'category' => 'string',
            'body' => 'string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        $lesson->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'content' => $request->body,
        ]);

        return $this->success(['message' => 'Lesson updated successfully', 'lesson' => $lesson], 200);
    }

    //deleteLesson
    public function deleteLesson(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)->where('instructor_id', $request->user()->id)->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $lesson->delete();

        return $this->success(['message' => 'Lesson deleted successfully'], 200);
    }

    //storeQuizByLessonId
    public function storeQuizByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        // Create the quiz
        $quiz = Quiz::create([
            'lesson_id' => $lesson->id,
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

        return $this->success(['message' => 'Quiz created successfully', 'quiz' => $quiz], 201);
    }

    //getQuizzesByLessonId
    public function getQuizzesByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $quizzes = Quiz::where('lesson_id', $lesson->id)->get();

        return $this->success(['quizzes' => $quizzes], 200);
    }

    //updateQuizByLessonId
    public function updateQuizByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'questions' => 'required|array',
            'questions.*.id' => 'required|integer|exists:questions,id',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array',
            'questions.*.options.*' => 'required|string',
            'questions.*.correct_answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 400);
        }

        // Update the quiz
        $quiz = Quiz::where('lesson_id', $lesson->id)->first();

        foreach ($request->questions as $questionData) {
            $question = $quiz->questions()->find($questionData['id']);

            if ($question) {
                $question->update(['question' => $questionData['question']]);

                // Update answers
                $question->answers()->delete();
                foreach ($questionData['options'] as $option) {
                    $question->answers()->create([
                        'answer_text' => $option,
                        'is_correct' => $option === $questionData['correct_answer'],
                    ]);
                }
            }
        }

        return $this->success(['message' => 'Quiz updated successfully'], 200);
    }

    //deleteQuizByLessonId
    public function deleteQuizByLessonId(Request $request, $id)
    {
        $lesson = Lesson::where('id', $id)
            ->where('instructor_id', $request->user()->id)
            ->first();

        if (!$lesson) {
            return $this->error(['message' => 'Lesson not found'], 404);
        }

        $quiz = Quiz::where('lesson_id', $lesson->id)->first();

        if (!$quiz) {
            return $this->error(['message' => 'Quiz not found'], 404);
        }

        $quiz->delete();

        return $this->success(['message' => 'Quiz deleted successfully'], 200);
    }
}
