<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;


class LoginAccount extends Controller
{
    public function store(Request $request) {
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = Customer::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        /*Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();*/

        $request->user()->tokens()->delete();

        // Auth::logout();

        return response()->json([
            'message' => 'loggout'
        ]);
    }
}
