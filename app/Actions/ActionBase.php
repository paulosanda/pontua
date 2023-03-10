<?php

namespace App\Actions;

use Illuminate\Validation\ValidationException;

abstract class ActionBase
{

    protected function validate(array $input, array $rules, array $messages = [])
    {
        $validator = app('validator')->make($input, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }
}
