<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_role.table_name') => route('admin.route_role.index'),
            $route_role->name => null,
        ]" />
    </div>

    <div class="mt-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-card.header>{{ __('actions.show') }}</x-card.header>
                <div class="mt-4">
                    <label class="block font-medium text-sm text-gray-700">{{ __('models.route_role.field.name') }}</label>
                    <p>{{ $route_role->name }}</p>
                </div>

                @if (auth()->user()->isRouteAllowed('admin.route_role.edit'))
                <div class="flex justify-end mt-4">
                    <x-links.button-info href="{{ route('admin.route_role.edit', $route_role) }}">
                        <span class="material-icons align-middle">edit</span>
                        <span>{{ __('actions.edit') }}</span>
                    </x-links.button-info>
                </div>
                @endif

                @if (auth()->user()->isRouteAllowed('admin.route_role.destroy'))
                <div class="flex justify-end mt-4">
                    <form action="{{ route('admin.route_role.destroy', $route_role) }}" method="POST" onsubmit="return confirm('{{ __('actions.confirm-destroy') }}')">
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

            <x-card.default>
                <x-card.header>{{ __('actions.index') }}</x-card.header>
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <x-tables.th>{{ __('models.user.field.name') }}</x-tables.th>
                        <x-tables.th>{{ __('models.user.field.email') }}</x-tables.th>
                        <x-tables.th class="text-right">
                            @if (auth()->user()->isRouteAllowed('admin.route_role.user.create'))
                                <x-links.button-info href="{{ route('admin.route_role.user.create', $route_role) }}">
                                    <span class="material-icons align-middle">create</span>
                                    <span>{{ __('actions.create') }}</span>
                                </x-links.button-info>
                            @endif
                        </x-tables.th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($route_role->users as $user)
                        <tr>
                            <x-tables.td>{{ $user->name }}</x-tables.td>
                            <x-tables.td>{{ $user->email }}</x-tables.td>
                            <x-tables.td class="text-right">
                                @if (auth()->user()->isRouteAllowed('admin.user.show'))
                                    <x-links.button-default href="{{ route('admin.user.show', $user) }}">
                                        <span class="material-icons align-middle">read_more</span>
                                        <span>{{ __('actions.show') }}</span>
                                    </x-links.button-default>
                                @endif
                            </x-tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-card.default>

            <x-card.default>
                <x-card.header>{{ __('actions.index') }}</x-card.header>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <x-tables.th>{{ __('models.route_policy.field.name') }}</x-tables.th>
                            <x-tables.th class="text-right">
                                @if (auth()->user()->isRouteAllowed('admin.route_role.route_policy.create'))
                                <x-links.button-info href="{{ route('admin.route_role.route_policy.create', $route_role) }}">
                                    <span class="material-icons align-middle">create</span>
                                    <span>{{ __('actions.create') }}</span>
                                </x-links.button-info>
                                @endif
                            </x-tables.th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($route_role->routePolicies as $route_policy)
                        <tr>
                            <x-tables.td>{{ $route_policy->name }}</x-tables.td>
                            <x-tables.td class="text-right">
                                @if (auth()->user()->isRouteAllowed('admin.route_policy.show'))
                                    <x-links.button-default href="{{ route('admin.route_policy.show', $route_policy) }}">
                                        <span class="material-icons align-middle">read_more</span>
                                        <span>{{ __('actions.show') }}</span>
                                    </x-links.button-default>
                                @endif
                            </x-tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-card.default>
        </div>
    </div>
</x-admin-layout>
