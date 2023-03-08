<?php

namespace App\Actions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

abstract class ActionBase
{
    /**
     * Execute the action.
     *
     * @param  array  $input
     * @return mixed
     */
    abstract public function execute(array $input);

    /**
     * Validate the input data.
     *
     * @param  array  $input
     * @param  array  $rules
     * @param  array  $messages
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validate(array $input, array $rules, array $messages = [])
    {
        $validator = app('validator')->make($input, $rules, $messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator;
    }
}
