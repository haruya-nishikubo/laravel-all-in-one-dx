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
        <x-forms.submit-success>{{ __('actions.save') }}</x-forms.submit-success>
    </div>
</div>
