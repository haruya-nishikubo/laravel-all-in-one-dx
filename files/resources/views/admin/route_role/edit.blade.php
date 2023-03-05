<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_role.table_name') => route('admin.route_role.index'),
            $route_role->name => route('admin.route_role.show', $route_role),
            __('actions.edit') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.edit') }}</x-card.header>
                <form action="{{ route('admin.route_role.update', $route_role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.route_role.form')
                </form>
            </x-card.default>
        </div>
    </div>
</x-admin-layout>
