<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordUser extends Controller
{
  /**
   * Write code on Method
   *
   */
  public function showForgetPasswordForm(): View
  {
    return view('api.forgetPassword');
  }

  /**
   * Write code on Method
   *
   */
  public function submitForgetPasswordForm(Request $request): JsonResponse
  {
    $request->validate([
      'email' => 'required|email',
    ]);

    $token = Str::random(64);

    DB::table('password_reset_tokens')->insertOrIgnore([
      'email' => $request->email,
      'token' => $token,
      'created_at' => Carbon::now()
    ],  ['email', 'token'], ['created_at']);

    $tokenData = DB::table('password_reset_tokens')
    ->where('email', $request->email)->first();
    $data = [
      'email' => $request->email,
      'token' => $tokenData->token,
    ];


    Mail::send('api/email_forget_password', ['data' => $data,], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject('Reset Password');
    });
    return response()->json([
      'message' => 'We have e-mailed your password reset link!'
    ]);
  }

  /**
   * Write code on Method
   *
   */
  public function showResetPasswordForm($token, $email): View
  {
    $data = [
      'email' => $email,
      'token' => $token,
    ];
    return view('api.email_reset_password', ['data' => $data]);
  }

  /**
   * Write code on Method
   *
   */
  public function submitResetPassword(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|string|min:8',
      'password_confirmation' => 'required'
    ]);

    $updatePassword = DB::table('password_reset_tokens')
      ->where([
        'email' => $request->email,
        'token' => $request->token
      ])
      ->first();

    if (!$updatePassword) {
      return "<h1>Invalid token</h1>";
    }
    $user = Customer::where('email', $request->email)
      ->update(['password' => Hash::make($request->password)]);

    DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
    return "<h1>Password cambiata con successo</h1>";
  }
}
