<x-Admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.user.table_name') => route('admin.user.index'),
            $user->name => route('admin.user.show', $user),
            __('actions.edit') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.edit') }}</x-card.header>
                <form action="{{ route('admin.user.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

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

                    <div class="flex justify-end mt-4">
                        <x-forms.submit-success>
                            <span class="material-icons align-middle">save</span>
                            <span>{{ __('actions.save') }}</span>
                        </x-forms.submit-success>
                    </div>
                </form>
            </x-card.default>
        </div>
    </div>
</x-Admin-layout>
