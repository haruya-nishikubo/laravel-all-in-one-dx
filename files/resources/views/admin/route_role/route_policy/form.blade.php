<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-4">
    <div class="mt-4">
        <ul class="list-disc">
            @foreach($route_policies as $route_policy)
                <li>
                    <label class="text-gray-700 font-semibold">
                        <input type="checkbox" name="route_role[route_policies][]" value="{{ $route_policy->id }}" @checked($route_role->routePolicies->pluck('id')->contains($route_policy->id)) />
                        <span class="text-sm">{{ $route_policy->name }}</span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div>
    <div class="flex justify-end mt-4">
        <button type="submit" class="btn btn-success">{{ __('actions.save') }}</button>
    </div>
</div>
