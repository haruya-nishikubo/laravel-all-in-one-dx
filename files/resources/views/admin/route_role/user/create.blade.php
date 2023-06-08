<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <nav class="rounded-md w-full">
            <ol class="list-reset flex">
                <li><a href="{{ route('admin.route_role.index') }}" class="text-dark-500 px-4 py-2 rounded-md hover:bg-dark-200">{{ __('models.route_role.table_name') }}</a></li>
                <li><span class="text-dark-500 mx-4">/</span></li>
                <li><a href="{{ route('admin.route_role.show', $route_role) }}" class="text-dark-500 px-4 py-2 rounded-md hover:bg-dark-200">{{ $route_role->name }}</a></li>
                <li><span class="text-dark-500 mx-4">/</span></li>
                <li class="text-dark-500 mx-4">{{ __('models.user.table_name') }}</li>
                <li><span class="text-dark-500 mx-4">/</span></li>
                <li class="text-dark-500 mx-4">{{ __('actions.create') }}</li>
            </ol>
        </nav>
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.create') }}</x-card.header>
                <form action="{{ route('admin.route_role.user.store', $route_role) }}" method="POST">
                    @csrf

                    @include('admin.route_role.user.form')
                </form>
            </x-card.default>
        </div>
    </div>
</x-admin-layout>
