<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/dashboard', DashboardController::class);
Route::resource('/mycourse', CourseController::class);
Route::get('/mycourse/task/{id}', [CourseController::class, 'task'])->name('mycourse.task');
Route::get('/mycourse/assignment/{id}', [CourseController::class, 'assignment'])->name('mycourse.assignment');
Route::resource('/assignment', AssignmentController::class);
Route::get('/assignment/task/{id}', [CourseController::class, 'task'])->name('assignment.task');
Route::post('/assignment', [CourseController::class, 'storeass']);
Route::get('/assignment/assignment/{id}', [CourseController::class, 'assignment'])->name('assignment.assignment');
Route::get('/assignment/edit/{id}', [CourseController::class, 'edit']);
Route::delete('/assignment/delete/{id}', [ScoreController::class, 'destroy']);
Route::resource('/schedule', ScheduleController::class);
Route::resource('/payment', PaymentController::class);
Route::post('/payment', [PaymentController::class, 'store']);
Route::get('/payment/edit/{id}', [PaymentController::class, 'edit']);
Route::put('/payment/update/{id}', [PaymentController::class, 'update']);
Route::delete('/payment/delete/{id}', [PaymentController::class, 'destroy']);

// Admin Dashboard
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

// Admin Schedule
Route::get('/admin/schedule', [ScheduleController::class, 'admin']);
Route::post('/admin/schedule', [ScheduleController::class, 'store']);
Route::get('/admin/schedule/edit/{id}', [ScheduleController::class, 'edit']);
Route::delete('/admin/schedule/{id}', [ScheduleController::class, 'destroy']);
Route::put('/admin/schedule/update/{id}', [ScheduleController::class, 'update']);
Route::get('/admin/schedule/create', [ScheduleController::class, 'create']);

// Admin Payment
Route::get('/admin/payment', [AdminPaymentController::class, 'index']);
Route::get('/admin/payment/come', [AdminPaymentController::class, 'come']);
Route::get('/admin/payment/approved', [AdminPaymentController::class, 'approved']);
Route::get('/admin/payment/unapproved', [AdminPaymentController::class, 'unapproved']);
Route::put('/admin/payment/{id}', [AdminPaymentController::class, 'edit']);
Route::post('/admin/payment/{id}', [AdminPaymentController::class, 'destroy']);

// Admin Account
Route::get('/admin/account', [AdminAccountController::class, 'index']);
