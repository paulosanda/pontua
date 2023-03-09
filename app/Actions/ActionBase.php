<?php

namespace App\Actions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

abstract class ActionBase
{

    abstract public function execute(array $input);


    protected function validate(array $input, array $rules, array $messages = [])
    {
        $validator = app('validator')->make($input, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }
}
