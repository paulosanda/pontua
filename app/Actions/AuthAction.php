<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthAction
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = Auth::user()->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
