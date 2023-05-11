<?php

namespace App\Http\Requests\Admin\RoutePolicy;

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
            'route_policy.name' => [
                'required',
                'string',
            ],

            'route_policy.allows' => [
                'required',
                'array',
            ],

        ];
    }
}
