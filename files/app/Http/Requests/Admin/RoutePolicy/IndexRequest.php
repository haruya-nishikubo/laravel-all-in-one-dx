<?php

namespace App\Http\Requests\Admin\RoutePolicy;

use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;
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
            'route_policy.name' => [
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

        $query = RoutePolicy::query();

        if (isset($validated['route_policy']['name'])) {
            $query->where('name', 'LIKE', "%{$validated['route_policy']['name']}%");
        }

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
