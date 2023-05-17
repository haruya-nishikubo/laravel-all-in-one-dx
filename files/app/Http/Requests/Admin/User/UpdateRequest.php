<?php

namespace App\Http\Requests\Admin\User;

class UpdateRequest extends StoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['user.password']);
        unset($rules['user.password_confirmation']);

        return $rules;
    }
}
