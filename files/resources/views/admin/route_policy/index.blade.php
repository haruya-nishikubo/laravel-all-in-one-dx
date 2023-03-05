<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_policy.table_name') => null,
        ]" />
    </div>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <x-card.default>
                    <form action="{{ route('admin.route_policy.index') }}" method="GET">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-forms.label :title="__('models.route_policy.field.name')">
                                    <x-forms.input type="text"
                                        name="route_policy[name]"
                                        value="{{ old('route_policy.name', $criteria['route_policy']['name'] ?? '') }}" />
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

            @if (auth()->user()->isRouteAllowed('admin.route_policy.import'))
            <div class="py-4">
                <x-card.default>
                    <form action="{{ route('admin.route_policy.import') }}" method="POST" enctype="multipart/form-data">
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

            <x-card.default>
                <table class="table-auto w-full">
                    <thead>
                        @if (auth()->user()->isRouteAllowed('admin.route_policy.export'))
                        <tr>
                            <x-tables.th class="text-right" colspan="3">
                                <x-links.button-info href="{{ route('admin.route_policy.export', array_merge($criteria, ['encoding' => 'sjis'])) }}">{{ __('actions.export') }}(win)</x-links.button-info>
                            </x-tables.th>
                        </tr>

                        <tr>
                            <x-tables.th class="text-right" colspan="3">
                                <x-links.button-info href="{{ route('admin.route_policy.export', $criteria) }}">{{ __('actions.export') }}(mac)</x-links.button-info>
                            </x-tables.th>
                        </tr>
                        @endif

                        @if (auth()->user()->isRouteAllowed('admin.route_policy.create'))
                        <tr>
                            <x-tables.th>{{ __('models.route_policy.field.name') }}</x-tables.th>
                            <x-tables.th class="text-right">
                                <x-links.button-info href="{{ route('admin.route_policy.create') }}">{{ __('actions.create') }}</x-links.button-info>
                            </x-tables.th>
                        </tr>
                        @endif
                    </thead>

                    <tbody>
                    @foreach($route_policies as $route_policy)
                        <tr>
                            <x-tables.td>{{ $route_policy->name }}</x-tables.td>
                            <x-tables.td class="text-right">
                                @if (auth()->user()->isRouteAllowed('admin.route_policy.show'))
                                <x-links.button-default href="{{ route('admin.route_policy.show', $route_policy) }}">{{ __('actions.show') }}</x-links.button-default>
                                @endif
                            </x-tables.td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-card.default>

            <div class="mt-4">
                {{ $route_policies->appends($criteria)->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
