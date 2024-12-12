<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordUser extends Controller
{
    public function update(Request $request) : JsonResponse
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', ],
            'confirm_password' => ['required', 'same:password'],
        ]);

        $customer = Customer::find($request->id);
        #Match The Old Password
        if(!Hash::check($request->old_password, $customer->password)){
            return  response()->json([
                'message'=> 'La password corrente è errata'
            ], 400);;
        }


        #Update the new Password
        Customer::whereId($customer->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message'=> 'Password cambiata con successo'
        ], 200);
    }
}
