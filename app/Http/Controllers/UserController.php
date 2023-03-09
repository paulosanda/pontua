<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\CreateUser;
use App\Actions\PasswordUpdate;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = app(CreateUser::class)->execute([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $update = app(PasswordUpdate::class)->execute($request);

        return response()->json($update);
    }
}
