<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\CreateUser;

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

        return $user;
    }
}
