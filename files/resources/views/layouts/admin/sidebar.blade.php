<div class="flex items-center justify-between rounded-md py-8 mt-8 ml-8 bg-gray-800/80">
    <ul>
        <li>
            <x-sidebar.label>アクセス管理</x-sidebar.label>
        </li>
        <ul class="ml-4 mt-4">
            @if(auth()->user()->isRouteAllowed('admin.route_role.index'))
            <li>
                <x-sidebar.link :href="route('admin.route_role.index')" :active="request()->routeIs('admin.route_role.*')">
                    {{ __('models.route_role.table_name') }}
                </x-sidebar.link>
            </li>
            @endif

            @if(auth()->user()->isRouteAllowed('admin.route_policy.index'))
            <li class="mt-2">
                <x-sidebar.link :href="route('admin.route_policy.index')" :active="request()->routeIs('admin.route_policy.*')">
                    {{ __('models.route_policy.table_name') }}
                </x-sidebar.link>
            </li>
            @endif
        </ul>
    </ul>
</div>
