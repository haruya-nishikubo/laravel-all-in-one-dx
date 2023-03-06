<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user.name' => [
                'required',
                'string',
            ],

            'user.email' => [
                'required',
                'string',
            ],

            'user.password' => [
                'required',
                'string',
            ],
        ];
    }
}
