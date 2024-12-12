<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CreateAccountUser extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'confirm_password' => ['required', 'same:password'],
            'device_token' => ['nullable', 'string'],
        ]);

        //Handle File Upload
        $user = Customer::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'device_token' => $request->token ?? '',
        ]);


        event(new Registered($user));

        Auth::login($user);

        $token = $user->createToken('api-token');


        return response()->json([
            'user' => $user,
            'message' => 'Utente registrato. Controlla la tua email per verificare',
            'token' => $token->plainTextToken,
        ]);
    }

    public function sendMail($email)
    {
        if (auth()->user()) {
            $user = Customer::where('email', $email)->get();

            if (count($user) > 0) {
                $domain = URL::to('/');
                $random = Str::random(64);
                $url = $domain . '/verify-email/' . $random;

                $data['url'] = $url;
                $data['name'] = auth()->user()->name;
                $data['email'] = $email;
                $data['title'] = 'Verifica Email';
                $data['body'] = 'Clicca per verificare la mail';

                Mail::send('api/verify_email', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });
                $user = Customer::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                return response()->json([
                    'stato' => true,
                    'message' => 'email inviata',
                ]);
            } else {
                return response()->json([
                    'state' => false,
                    'message' => 'Utente non trovato',
                ], 400);
            }
        } else {
            return response()->json([
                'state' => false,
                'message' => 'Utente non autenticato',
            ]);
        }
    }

    public function verificationEmail($token)
    {
        $user = Customer::where('remember_token', $token)->get();

        if (count($user) > 0) {
            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            $user = Customer::find($user[0]['id']);
            $user->remember_token = '';
            $user->is_verified = 1;
            $user->email_verified_at = $datetime;
            $user->save();


            return "<h1>Email verificata con successo</h1>";
        } else {
            return view('api/404');
        }
    }
}
