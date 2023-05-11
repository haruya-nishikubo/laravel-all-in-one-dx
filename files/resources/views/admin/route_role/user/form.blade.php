    <div class="mt-4">
        <ul class="list-disc">
            @foreach($users as $user)
                <li>
                    <label class="text-gray-700 font-semibold">
                        <input type="checkbox" name="route_role[users][]" value="{{ $user->id }}" @checked($route_role->users->pluck('id')->contains($user->id)) />
                        <span class="text-sm">{{ $user->name }}</span>
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
