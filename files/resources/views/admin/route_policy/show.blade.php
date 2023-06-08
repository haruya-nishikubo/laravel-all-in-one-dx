<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_policy.table_name') => route('admin.route_policy.index'),
            $route_policy->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.show') }}</x-card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-dark-700">{{ __('models.route_policy.field.name') }}</label>
                    <p>{{ $route_policy->name }}</p>
                </div>

                <div class="mt-4">
                    <label class="block font-medium text-sm text-dark-700">{{ __('models.route_policy.field.allows') }}</label>
                    <ul class="list-disc">
                        @foreach($route_policy->allows ?? [] as $route)
                            <li>{{ $route }}</li>
                        @endforeach
                    </ul>
                </div>

                @if (auth()->user()->isRouteAllowed('admin.route_policy.edit'))
                <div class="flex justify-end mt-4">
                    <x-links.button-info href="{{ route('admin.route_policy.edit', $route_policy) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('actions.edit') }}</span>
                    </x-links.button-info>
                </div>
                @endif

                @if (auth()->user()->isRouteAllowed('admin.route_policy.destroy'))
                <div class="flex justify-end mt-4">
                    <form action="{{ route('admin.route_policy.destroy', $route_policy) }}" method="POST" onsubmit="return confirm('{{ __('actions.confirm-destroy') }}')">
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
</x-admin-layout>
