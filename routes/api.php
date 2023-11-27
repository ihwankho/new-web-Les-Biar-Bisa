<?php

use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\FileCourseController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ScoreController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TingkatanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Users
Route::get('/users', [StudentController::class, 'index']);
Route::get('/users/{id}', [StudentController::class, 'show']);
Route::post('/users', [StudentController::class, 'store']);
Route::patch('users/{id}', [StudentController::class, 'update']);
Route::delete('users/{id}', [StudentController::class, 'destroy']);

// Tingkatan
Route::get('/tingkatan', [TingkatanController::class, 'index']);
Route::get('/tingkatan/{id}', [TingkatanController::class, 'show']);
Route::post('/tingkatan', [TingkatanController::class, 'store']);
Route::patch('/tingkatan/{id}', [TingkatanController::class, 'update']);
Route::delete('/tingkatan/{id}', [TingkatanController::class, 'destroy']);

// Course
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::patch('/courses/{id}', [CourseController::class, 'update']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

// Assignment
Route::get('/assignments', [AssignmentController::class, 'index']);
Route::get('/assignments/{id}', [AssignmentController::class, 'show']);
Route::post('/assignments', [AssignmentController::class, 'store']);
Route::patch('/assignments/{id}', [AssignmentController::class, 'update']);
Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy']);

// File Course
Route::get("/filecourses", [FileCourseController::class, 'index']);
Route::get("/filecourses/{id}", [FileCourseController::class, 'show']);
Route::post("/filecourses", [FileCourseController::class, 'store']);
Route::patch("/filecourses/{id}", [FileCourseController::class, 'update']);
Route::delete("/filecourses/{id}", [FileCourseController::class, 'destroy']);

// Score
Route::get('/scores', [ScoreController::class, 'index']);
Route::get('/scores/{id}', [ScoreController::class, 'show']);
Route::post('/scores', [ScoreController::class, 'store']);
Route::patch('/scores/{id}', [ScoreController::class, 'update']);
Route::delete('/scores/{id}', [ScoreController::class, 'destroy']);

// Payment
Route::get('/payments', [PaymentController::class, 'index']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::patch('/payments/{id}', [PaymentController::class, 'update']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
