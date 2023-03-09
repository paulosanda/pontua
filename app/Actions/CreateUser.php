<?php

namespace App\Actions;

use App\Models\User;

class CreateUser extends ActionBase
{
    public function execute(array $input)
    {
        $this->validate($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);

        return response()->json($user);
    }
}
