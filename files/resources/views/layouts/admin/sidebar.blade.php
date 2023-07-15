<div class="flex items-center justify-between rounded-md py-8 mt-8 ml-8 bg-secondary-100">
    <ul>
        <li>
            <x-sidebar.label>アクセス管理</x-sidebar.label>
        </li>
        <ul class="ml-4 mt-4">
            @if(auth()->user()->isRouteAllowed('admin.user.index'))
            <li>
                <x-sidebar.link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.*')">
                    <span class="material-icons align-middle">person</span>
                    <span>{{ __('models.user.table_name') }}</span>
                </x-sidebar.link>
            </li>
            @endif

            @if(auth()->user()->isRouteAllowed('admin.route_role.index'))
            <li class="mt-2">
                <x-sidebar.link :href="route('admin.route_role.index')" :active="request()->routeIs('admin.route_role.*')">
                    <span class="material-icons align-middle">manage_accounts</span>
                    <span>{{ __('models.route_role.table_name') }}</span>
                </x-sidebar.link>
            </li>
            @endif

            @if(auth()->user()->isRouteAllowed('admin.route_policy.index'))
            <li class="mt-2">
                <x-sidebar.link :href="route('admin.route_policy.index')" :active="request()->routeIs('admin.route_policy.*')">
                    <span class="material-icons align-middle">policy</span>
                    <span>{{ __('models.route_policy.table_name') }}</span>
                </x-sidebar.link>
            </li>
            @endif
        </ul>
    </ul>
</div>
