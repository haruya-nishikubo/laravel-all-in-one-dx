<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rule;

class ExportRequest extends IndexRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'encoding' => [
                'nullable',
                Rule::in([
                    'sjis',
                ]),
            ],
        ]);
    }
}
