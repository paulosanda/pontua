<?php

namespace App\Actions;

use App\Models\Fish;
use Illuminate\Support\Facades\Auth;

class FishStore extends ActionBase
{

    public function execute($input)
    {
        $this->validate($input, [
            'name' => 'string|required',
            'scientific_name' => 'string|required',
        ]);

        $user_id = Auth::user()->id;

        $fish = Fish::create([
            'user_id' => $user_id,
            'name' => $input['name'],
            'scientific_name' => $input['scientific_name'],
        ]);

        return $fish;
    }
}
