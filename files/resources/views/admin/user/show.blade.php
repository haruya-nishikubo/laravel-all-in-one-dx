<x-Admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.user.table_name') => route('admin.user.index'),
            $user->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.show') }}</x-card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-dark-700">{{ __('models.user.field.name') }}</label>
                    <p>{{ $user->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-dark-700">{{ __('models.user.field.email') }}</label>
                    <p>{{ $user->email }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-dark-700">{{ __('models.user.field.email_verified_at') }}</label>
                    <p>{{ $user->email_verified_at }}</p>
                </div>

                @if (auth()->user()->isRouteAllowed('admin.user.edit'))
                <div class="flex justify-end mt-4">
                    <x-links.button-info href="{{ route('admin.user.edit', $user) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('actions.edit') }}</span>
                    </x-links.button-info>
                </div>
                @endif

                @if (auth()->user()->isRouteAllowed('admin.user.destroy'))
                <div class="flex justify-end mt-4">
                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST" onsubmit="return confirm('{{ __('actions.confirm-destroy') }}')">
                        @csrf
                        @method('DELETE')

                        <x-forms.submit-danger>
                            <span class="material-icons align-middle">delete</span>
                            <span>{{ __('actions.destroy') }}</span>
                        </x-forms.submit-danger>
                    </form>
                </div>
                @endif
            </x-card.default>

        </div>
    </div>
</x-Admin-layout>
