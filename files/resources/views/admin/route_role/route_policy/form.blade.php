    <div class="mt-4">
        <ul class="list-disc">
            @foreach($route_policies as $route_policy)
                <li>
                    <label class="text-dark-700 font-semibold">
                        <input type="checkbox" name="route_role[route_policies][]" value="{{ $route_policy->id }}" @checked($route_role->routePolicies->pluck('id')->contains($route_policy->id)) />
                        <span class="text-sm">{{ $route_policy->name }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="flex justify-end mt-4">
        <x-forms.submit-success>
            <span class="material-icons align-middle">save</span>
            <span>{{ __('actions.save') }}</span>
        </x-forms.submit-success>
    </div>
