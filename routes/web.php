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
Route::resource('/assignment', CourseController::class);
Route::get('/assignment/task/{id}', [CourseController::class, 'task'])->name('assignment.task');
Route::post('/assignment/{id_assignment}', [CourseController::class, 'storeass'])->name('assignment.storeass');
Route::get('/assignment/assignment/{id}', [CourseController::class, 'assignment'])->name('assignment.assignment');
Route::resource('/schedule', ScheduleController::class);
Route::resource('/assignment', AssignmentController::class);
Route::resource('/payment', PaymentController::class);
Route::resource('/admin/dashboard', AdminDashboardController::class);
Route::resource('/admin/course', AdminCourseController::class);
Route::resource('/admin/schedule', AdminScheduleController::class);
Route::resource('/admin/payment', AdminPaymentController::class);
Route::resource('/admin/account', AdminAccountController::class);
