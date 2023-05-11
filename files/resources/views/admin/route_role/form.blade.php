    <div class="mt-4">
        <x-forms.label :required="true"
                       :title="__('models.route_role.field.name')">
            <x-forms.input type="text"
                           name="route_role[name]"
                           value="{{ old('route_role.name', $route_role->name) }}"
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
