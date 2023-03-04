<x-app-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_role.table_name') => route('admin.route_role.index'),
            $route_role->name => null,
        ]" />
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('models.route_role.field.name') }}</label>
                    <p>{{ $route_role->name }}</p>
                </div>

                <div class="flex justify-end mt-4">
                    <x-links.button-info href="{{ route('admin.route_role.edit', $route_role) }}">{{ __('actions.edit') }}</x-links.button-info>
                </div>

                <div class="flex justify-end mt-4">
                    <form actions="{{ route('admin.route_role.destroy', $route_role) }}" method="POST" onsubmit="return confirm('{{ __('actions.confirm-destroy') }}')">
                        @csrf
                        @method('DELETE')

                        <x-forms.submit-danger>{{ __('actions.destroy') }}</x-forms.submit-danger>
                    </form>
                </div>
            </x-card.default>

        </div>
    </div>
</x-app-layout>
