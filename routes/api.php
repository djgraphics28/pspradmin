<?php

use App\Http\Controllers\API\InstructorController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Student
Route::group(['prefix' => 'student'], function () {
    //public
    Route::post('/register', [StudentController::class, 'register']);
    Route::post('/login', [StudentController::class, 'login']);

    //private
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/profile', [StudentController::class, 'profile']);
        Route::put('/profile', [StudentController::class, 'updateProfile']);
        Route::put('/change-password', [StudentController::class, 'changePassword']);
        Route::post('/logout', [StudentController::class, 'logout']);

        Route::get('/categories', [StudentController::class, 'categories']);

        Route::get('/{categoryId}/lessons', [StudentController::class, 'lessonsByCategory']);
        Route::get('/lesson/{lessonId}', [StudentController::class, 'lessonInfo']);
        Route::get('lesson/{lessonId}/quizzes', [StudentController::class, 'getQuizzesByLessonId']);
        //take quiz
        Route::post('/quizzes/{quizId}/take', [StudentController::class, 'takeQuiz']);


    });
});

//Instructor
Route::group(['prefix' => 'instructor'], function () {
    //public
    Route::post('/login', [InstructorController::class, 'login']);

    //private
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/profile', [InstructorController::class, 'profile']);
        Route::put('/profile', [InstructorController::class, 'updateProfile']);
        Route::put('/change-password', [InstructorController::class, 'changePassword']);
        Route::post('/logout', [InstructorController::class, 'logout']);

        Route::get('/categories', [InstructorController::class, 'categories']);

        Route::get('/lessons',[InstructorController::class, 'getLessons']);
        Route::post('/lessons', [InstructorController::class, 'storeLesson']);
        Route::put('/lessons/{lessonId}', [InstructorController::class, 'updateLesson']);
        Route::delete('/lessons/{lessonId}', [InstructorController::class, 'deleteLesson']);

        Route::post('/{lessonId}/quizzes', [InstructorController::class, 'storeQuizByLessonId']);
        Route::put('/quizzes/{quizId}', [InstructorController::class, 'updateQuiz']);
        Route::get('/{lessonId}/quizzes', [InstructorController::class, 'getQuizzesByLessonId']);
        Route::delete('/quizzes/{quizId}', [InstructorController::class, 'deleteQuiz']);

        Route::get('/{quizId}/user-answers/student-lists', [InstructorController::class, 'getStudentListFromUserAnswerModel']);
        Route::get('/{quizId}/user-answers/{studentId}/info', [InstructorController::class, 'getUserAnswerInfoByStudentId']);

    });
});
