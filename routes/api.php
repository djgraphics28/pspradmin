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
        Route::post('/logout', [StudentController::class, 'logout']);

        Route::get('/categories', [StudentController::class, 'categories']);

        Route::get('/{categoryId}/lessons', [StudentController::class, 'lessonsByCategory']);
        Route::get('/lesson/{lessonId}', [StudentController::class, 'lessonInfo']);
    });
});

//Instructor
Route::group(['prefix' => 'instructor'], function () {
    //public
    Route::post('/login', [InstructorController::class, 'login']);

    //private
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/profile', [InstructorController::class, 'profile']);
        Route::post('/logout', [InstructorController::class, 'logout']);
    });
});
