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
       * @return response()
       */
      public function showForgetPasswordForm(): View
      {
         return view('api.forgetPassword');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request): JsonResponse
      {
          $request->validate([
              'email' => 'required|email|exists:customers',
          ]);

          $token = Str::random(64);

          DB::table('password_reset_tokens')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);



            Mail::send('api/email_forget_password', ['token' => $token], function($message) use($request){
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
       * @return response()
       */
      public function showResetPasswordForm($token): View
      {
         return view('api.email_reset_password', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request): JsonResponse
      {
          $request->validate([
              'email' => 'required|email|exists:customers',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_reset_tokens')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
            return response()->json([
                'message' => 'Invalid token!'
            ]);
          }

          $user = Customer::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_reset_tokens')->where(['email'=> $request->email])->delete();
          return response()->json([
            'message' => 'Your password has been changed!'
        ]);
      }

}
