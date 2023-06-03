<x-admin-layout>
    <div class="mt-8 mb-4 sm:px-6 lg:px-8">
        <x-breadcrumb.default :items="[
            __('models.route_policy.table_name') => null,
        ]" />
    </div>

    {{-- list --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <x-card.default>
            <x-card.header>{{ __('actions.index') }}</x-card.header>
            <table class="table-auto w-full">
                <thead>
                @if (auth()->user()->isRouteAllowed('admin.route_policy.export'))
                    <tr>
                        <x-tables.th class="text-right" colspan="3">
                            <x-links.button-info href="{{ route('admin.route_policy.export', array_merge($criteria, ['encoding' => 'sjis'])) }}">
                                <span class="material-icons align-middle">file_download</span>
                                <span>{{ __('actions.export') }}(win)</span>
                            </x-links.button-info>
                            <x-links.button-info href="{{ route('admin.route_policy.export', $criteria) }}">
                                <span class="material-icons align-middle">file_download</span>
                                <span>{{ __('actions.export') }}(mac)</span>
                            </x-links.button-info>
                        </x-tables.th>
                    </tr>
                @endif

                <tr>
                    <x-tables.th>{{ __('models.route_policy.field.name') }}</x-tables.th>
                    <x-tables.th class="text-right">
                        @if (auth()->user()->isRouteAllowed('admin.route_policy.create'))
                            <x-links.button-info href="{{ route('admin.route_policy.create') }}">
                                <span class="material-icons align-middle">create</span>
                                <span>{{ __('actions.create') }}</span>
                            </x-links.button-info>
                        @endif
                    </x-tables.th>
                </tr>
                </thead>

                <tbody>
                @foreach($route_policies as $route_policy)
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

            <div class="mt-4">
                {{ $route_policies->appends($criteria)->links() }}
            </div>
        </x-card.default>
    </div>

    {{-- search --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
        <x-card.default>
            <x-card.header>{{ __('actions.search') }}</x-card.header>
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
                        <x-forms.submit-info>
                            <span class="material-icons align-middle">search</span>
                            <span>{{ __('actions.search') }}</span>
                        </x-forms.submit-info>
                    </div>
                </div>
            </form>
        </x-card.default>
    </div>

    {{-- import --}}
    @if (auth()->user()->isRouteAllowed('admin.route_policy.import'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
            <x-card.default>
                <x-card.header>{{ __('actions.import') }}</x-card.header>
                <form action="{{ route('admin.route_policy.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf

                    <div>
                        <x-forms.label :required="true" title="CSV">
                            <x-forms.input type="file" name="source" required="required" />
                        </x-forms.label>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-forms.submit-success>
                            <span class="material-icons align-middle">file_upload</span>
                            <span>{{ __('actions.import') }}</span>
                        </x-forms.submit-success>
                    </div>
                </form>
            </x-card.default>
        </div>
    @endif
</x-admin-layout>
