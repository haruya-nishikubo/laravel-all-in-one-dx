<x-Admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.user.table_name') => route('admin.user.index'),
            __('actions.create') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.create') }}</x-card.header>
                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf

                    @include('admin.user.form')
                </form>
            </x-card.default>
        </div>
    </div>
</x-Admin-layout>
