<?php

namespace App\Http\Requests\Admin\RouteRole\RoutePolicy;

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
            'route_role.route_policies' => [
                'nullable',
                'array',
            ],
        ];
    }
}
