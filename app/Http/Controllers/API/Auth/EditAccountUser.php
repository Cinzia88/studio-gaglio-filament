<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class EditAccountUser extends Controller
{
    public function update(Request $request)
    {

        $user = Customer::find($request->id);
        $validated = $request->validate([
            'nome' => [ 'string', 'max:255'],
            'cognome' => [ 'string', 'max:255'],
            'telefono' => [ 'string'],
            'email' => [ 'string', 'email'],
            'device_token' => ['nullable', 'string'],
        ]);

        $user->update($validated);

        return response()->json([
            'user' => $user,
            'status' => 'Dati utente modificati.'
        ]);
    }

    public function saveToken(Request $request)
    {
        $userId = Customer::find($request->id);
        $validated = $request->validate([

            'device_token' => [ 'string'],
        ]);
        $userId->update($validated);
        return response()->json(['token saved successfully.']);
    }
}
