<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_role.table_name') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <x-card.default>
                    <x-card.header>{{ __('actions.filter') }}</x-card.header>
                    <form action="{{ route('admin.route_role.index') }}" method="GET">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-forms.label :title="__('models.route_role.field.name')">
                                <x-forms.input type="text"
                                    name="route_role[name]"
                                    value="{{ old('route_role.name', $criteria['route_role']['name'] ?? '') }}" />
                            </x-forms.label>
                        </div>

                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-forms.select name="sort_by">
                                    <option value="id">ID</option>
                                </x-forms.select>
                            </div>

                            <div class="flex justify-end">
                                <x-forms.submit-info>{{ __('actions.filter') }}</x-forms.submit-info>
                            </div>
                        </div>
                    </form>
                </x-card.default>
            </div>

            <x-card.default>
                <x-card.header>{{ __('actions.index') }}</x-card.header>
                <table class="table-auto w-full">
                    <thead>
                        @if (auth()->user()->isRouteAllowed('admin.route_role.export'))
                        <tr>
                            <x-tables.th class="text-right" colspan="2">
                                <x-links.button-info href="{{ route('admin.route_role.export', array_merge($criteria, ['encoding' => 'sjis'])) }}">{{ __('actions.export') }}(win)</x-links.button-info>
                                <x-links.button-info href="{{ route('admin.route_role.export', $criteria) }}">{{ __('actions.export') }}(mac)</x-links.button-info>
                            </x-tables.th>
                        </tr>
                        @endif

                        @if (auth()->user()->isRouteAllowed('admin.route_role.create'))
                        <tr>
                            <x-tables.th>{{ __('models.route_role.field.name') }}</x-tables.th>
                            <x-tables.th class="text-right">
                                <x-links.button-info href="{{ route('admin.route_role.create') }}">{{ __('actions.create') }}</x-links.button-info>
                            </x-tables.th>
                        </tr>
                        @endif
                    </thead>

                    <tbody>
                    @foreach($route_roles as $route_role)
                        <tr>
                            <x-tables.td>{{ $route_role->name }}</x-tables.td>
                            <x-tables.td class="text-right">
                                @if (auth()->user()->isRouteAllowed('admin.route_role.show'))
                                <x-links.button-default href="{{ route('admin.route_role.show', $route_role) }}">{{ __('actions.show') }}</x-links.button-default>
                                @endif
                            </x-tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $route_roles->appends($criteria)->links() }}
                </div>
            </x-card.default>

            @if (auth()->user()->isRouteAllowed('admin.route_role.import'))
                <div class="py-4">
                    <x-card.default>
                        <x-card.header>{{ __('actions.import') }}</x-card.header>
                        <form action="{{ route('admin.route_role.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf

                            <div>
                                <x-forms.label :required="true" title="CSV">
                                    <x-forms.input type="file" name="source" required="required" />
                                </x-forms.label>
                            </div>

                            <div class="flex justify-end mt-4">
                                <x-forms.submit-success>{{ __('actions.import') }}</x-forms.submit-success>
                            </div>
                        </form>
                    </x-card.default>
                </div>
            @endif

        </div>
    </div>
</x-admin-layout>
