<?php

use App\Http\Controllers\API\Auth\LoginAccount;
use App\Http\Controllers\API\Auth\ChangePasswordUser;
use App\Http\Controllers\API\Auth\CreateAccountUser;
use App\Http\Controllers\API\Auth\DeleteAccountUser;
use App\Http\Controllers\API\Auth\EditAccountUser;
use App\Http\Controllers\API\Auth\ForgotPasswordUser;
use App\Http\Controllers\API\Bookings\BookingsApp;
use App\Http\Controllers\API\Messages\MessagesApp;
use App\Http\Controllers\API\News\NewsApp;
use App\Http\Controllers\API\Notifications\NotificationsApp;
use App\Http\Controllers\API\Services\ServicesApp;
use App\Http\Controllers\API\Timetable\TimetableApp;
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


Route::middleware('guest')->group(function () {
    Route::post('/register', [CreateAccountUser::class, 'store']);
    Route::post('/login', [LoginAccount::class, 'store']);
    Route::get('/forget-password', [ForgotPasswordUser::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordUser::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordUser::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordUser::class, 'submitResetPasswordForm'])->name('reset.password.post');
    //Route::post('/forgot-password', [ForgotPasswordUser::class, 'forgot']);
});

Route::middleware('auth:sanctum')->group(function () {
    //prendere i dati dell' utente
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //gestione autenticazione e dati account dell' utente
    Route::post('/delete-account', [DeleteAccountUser::class, 'destroy']);
    Route::get('send-verify-mail/{email}', [CreateAccountUser::class, 'sendMail']);
    Route::post('/change-password', [ChangePasswordUser::class, 'update']);
    Route::post('/logout', [LoginAccount::class, 'destroy']);

    Route::put('/edit-user/{id}', [EditAccountUser::class, 'update']);
    Route::put('/save-token/{id}', [EditAccountUser::class, 'saveToken']);

    Route::get('/servizi', [ServicesApp::class, 'show']);

    Route::get('/news', [NewsApp::class, 'show']);
    Route::delete('/delete-new', [NewsApp::class, 'destroy']);


    Route::get('/bookings', [BookingsApp::class, 'show']);
    Route::post('/create-booking', [BookingsApp::class, 'store']);
    Route::delete('/delete-booking', [BookingsApp::class, 'destroy']);

    Route::get('/messages', [MessagesApp::class, 'show']);
    Route::post('/create-message', [MessagesApp::class, 'store']);
    Route::delete('/delete-message', [MessagesApp::class, 'destroy']);

    Route::get('/notification', [NotificationsApp::class, 'show']);
    Route::delete('/delete-notification', [NotificationsApp::class, 'destroy']);

    Route::get('/timetable', [TimetableApp::class, 'show']);
    Route::post('/create-timetable', [TimetableApp::class, 'store']);
    Route::delete('/delete-timetable', [TimetableApp::class, 'destroy']);



});
