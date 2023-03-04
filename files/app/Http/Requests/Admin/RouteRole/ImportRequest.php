<?php

namespace App\Http\Requests\Admin\RouteRole;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'source' => [
                'required',
                'file',
                'mimes:csv',
            ],
        ];
    }
}
