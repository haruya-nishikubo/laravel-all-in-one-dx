    <div class="mt-4">
        <x-forms.label :required="true"
                       :title="__('models.user.field.name')">
            <x-forms.input type="text"
                           name="user[name]"
                           value="{{ old('user.name', $user->name) }}"
                           required="required" />
        </x-forms.label>
    </div>

    <div class="mt-4">
        <x-forms.label :required="true"
                       :title="__('models.user.field.email')">
            <x-forms.input type="text"
                           name="user[email]"
                           value="{{ old('user.email', $user->email) }}"
                           required="required" />
        </x-forms.label>
    </div>

<div>
    <div class="flex justify-end mt-4">
        <x-forms.submit-success>
            <span class="material-icons align-middle">save</span>
            <span>{{ __('actions.save') }}</span>
        </x-forms.submit-success>
    </div>
</div>
