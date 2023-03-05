    <div class="mt-4">
        <x-forms.label :required="true"
                       :title="__('models.route_policy.field.name')">
            <x-forms.input type="text"
                           name="route_policy[name]"
                           value="{{ old('route_policy.name', $route_policy->name) }}"
                           required="required" />
        </x-forms.label>
    </div>

    <div class="mt-4">
        <ul class="list-disc">
            @foreach($routes as $route)
                <li>
                    <x-forms.label :title="null">
                        <input type="checkbox"
                                       name="route_policy[allows][]"
                                       value="{{ $route['name'] }}"
                                        @checked(in_array($route['name'], $route_policy->allows ?? [])) />
                        <span class="text-sm">{{ $route['name'] }}({{ collect($route['methods'])->implode(', ') }}: {{ $route['uri'] }})</span>
                    </x-forms.label>
                </li>
            @endforeach
        </ul>
    </div>

<div>
    <div class="flex justify-end mt-4">
        <x-forms.submit-success>
            <span class="material-icons align-middle">save</span>
            <span>{{ __('actions.save') }}</span>
        </x-forms.submit-success>
    </div>
</div>
