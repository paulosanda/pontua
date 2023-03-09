<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CreateUser extends ActionBase
{
    public function execute(array $input)
    {
        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->messages()
            ]);
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        return $user;
    }
}
