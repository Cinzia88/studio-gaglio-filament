<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\ForgotPasswordUser;
use App\Http\Controllers\API\Auth\CreateAccountUser;


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


Route::get('reset-password/{token}', [ForgotPasswordUser::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::get('/verify-email/{token}', [CreateAccountUser::class, 'verificationEmail']);
