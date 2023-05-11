<?php

namespace App\Http\Requests\Admin\RouteRole;

use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
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
            'route_role.name' => [
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

        $query = RouteRole::query();

        if (isset($validated['route_role']['name'])) {
            $query->where('name', 'LIKE', "%{$validated['route_role']['name']}%");
        }

        $query->latest($validated['sort_by'] ?? 'id');

        return $query;
    }
}
