<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminCourseController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\SendNotificationsController;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;
use App\Mail\QuizNotificationMail;
use Illuminate\Support\Facades\Mail;

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

Route::get("/login", [AuthenticationController::class, 'login_user']);
Route::post("/login", [AuthenticationController::class, 'user_login']);

Route::middleware('LoginUser')->group(function () {
    Route::get("/", function () {
        return redirect("/dashboard");
    });
    Route::get("/admin", function () {
        return redirect("/admin/dashboard");
    });
    Route::get("/logout", [AuthenticationController::class, 'user_logout']);
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
    Route::post('/admin/schedule/update/{id}', [ScheduleController::class, 'update']);
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
    Route::get('/admin/account/create', [AdminAccountController::class, 'create']);
    Route::get('/admin/account/edit/{id}', [AdminAccountController::class, 'edit']);
    Route::put('/admin/account/{id}', [AdminAccountController::class, 'update']);
    Route::post('/admin/account', [AdminAccountController::class, 'store']);
    Route::delete('/admin/account/{id}', [AdminAccountController::class, 'destroy']);

    // Admin Course
    Route::get('/admin/course', [AdminCourseController::class, 'index']);
    Route::get('/admin/course/sd', [AdminCourseController::class, 'sd']);
    Route::get('/admin/course/smp', [AdminCourseController::class, 'smp']);
    Route::get('/admin/course/sma', [AdminCourseController::class, 'sma']);
    Route::get('/admin/course/create', [AdminCourseController::class, 'create']);
    Route::get('/admin/course/edit/{id}', [AdminCourseController::class, 'edit']);
    Route::post('/admin/course', [AdminCourseController::class, 'store']);
    Route::post('/admin/course/{id}', [AdminCourseController::class, 'update']);
    Route::delete('/admin/course/{id}', [AdminCourseController::class, 'destroy']);
    Route::get('/admin/course/{id}', [AdminCourseController::class, 'show']);
    Route::get('/admin/course/{id}/materi/add', [AdminCourseController::class, 'addmateri']);
    Route::post('/admin/course/{id}/materi', [AdminCourseController::class, 'storemateri']);
    Route::get('/admin/course/materi/edit/{id}', [AdminCourseController::class, 'editmateri']);
    Route::post('/admin/course/materi/edit/{id}', [AdminCourseController::class, 'updatemateri']);
    Route::delete('/admin/course/materi/delete/{id}', [AdminCourseController::class, 'destroymateri']);
    Route::get('/admin/course/{id}/task/add', [AdminCourseController::class, 'addtask']);
    Route::post('/admin/course/{id}/task', [AdminCourseController::class, 'storetask']);
    Route::get('/admin/course/task/edit/{id}', [AdminCourseController::class, 'edittask']);
    Route::put('/admin/course/task/edit/{id}', [AdminCourseController::class, 'updatetask']);
    Route::delete('/admin/course/task/delete/{id}', [AdminCourseController::class, 'destroytask']);
    Route::get('/admin/course/task/{id}', [AdminCourseController::class, 'assignment']);
    Route::put('/admin/course/task/{id}', [AdminCourseController::class, 'nilai']);

    // Routing untuk quiz
    Route::get('/admin/quiz', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/admin/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
    Route::post('/admin/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
    Route::get('/admin/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::delete('/quiz/{quiz}', [QuizController::class, 'destroy'])->name('quiz.destroy');

    //question
    Route::post('/quiz/{quiz}/questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::get('/admin/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::delete('/admin/questions/{id}}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    // jawaban
    Route::post('/quiz/{quiz}/questions/answers/store', [AnswerController::class, 'store'])->name('answers.store');

    // quizzess

    Route::get('/quizzess', [QuizController::class, 'studentindex']);
    Route::post('/quizzess/{quiz}', [QuizController::class, 'studentsubmit']);
    Route::get('/quizzess/{id}', [QuizController::class, 'studentshow']);
    Route::get("/admin/quizzes/{quizId}", [QuizController::class, 'status']);

    //NOTIF
    Route::get('/send-notifications/{notification}', [SendNotificationsController::class, 'sendnotification']);
});
