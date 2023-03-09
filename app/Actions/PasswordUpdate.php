<?php

namespace App\Actions;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class PasswordUpdate
{
    public function execute(Request $request)
    {

        $rules = [
            'new_password' => 'required|min:8',
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $response = Password::reset(
            $this->credentials($request),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($response == Password::INVALID_TOKEN) {
            return ['success' => false, 'error' => 'Token inválido'];
        }

        return ['success' => true, 'message' => 'Senha redefinida com sucesso'];
    }

    protected function credentials(Request $request)
    {
        return [
            'password' => $request->input('new_password'),
        ];
    }
}
