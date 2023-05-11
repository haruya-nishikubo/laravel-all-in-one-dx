<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends FormRequest
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
                'nullable',
                'string',
            ],

            'user.email' => [
                'nullable',
                'string',
            ],

            'user.start_email_verified_at' => [
                'nullable',
                'date',
            ],

            'user.end_email_verified_at' => [
                'nullable',
                'date',
            ],

            'user.password' => [
                'nullable',
                'string',
            ],

            'user.remember_token' => [
                'nullable',
                'string',
            ],

            'sort_by' => [
                'nullable',
                Rule::in([
                    'id',
                ]),
            ],
        ];
    }

    public function queryWithValidated(): Builder
    {
        $validated = $this->validated();

        $query = User::query();

        if (isset($validated['user']['name'])) {
            $query->where('name', 'LIKE', "%{$validated['user']['name']}%");
        }

        if (isset($validated['user']['email'])) {
            $query->where('email', 'LIKE', "%{$validated['user']['email']}%");
        }

        if (isset($validated['user']['start_email_verified_at'])) {
            $query->where('email_verified_at', '>=', "{$validated['user']['start_email_verified_at']}");
        }

        if (isset($validated['user']['end_email_verified_at'])) {
            $query->where('email_verified_at', '<', "{$validated['user']['end_email_verified_at']}");
        }

        if (isset($validated['user']['password'])) {
            $query->where('password', 'LIKE', "%{$validated['user']['password']}%");
        }

        if (isset($validated['user']['remember_token'])) {
            $query->where('remember_token', 'LIKE', "%{$validated['user']['remember_token']}%");
        }

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
