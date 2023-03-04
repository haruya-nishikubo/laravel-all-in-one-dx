<div class="flex items-center justify-between py-12">
    <ul>
        <li>
            <x-admin-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-admin-nav-link>
        </li>

        <li class="mt-4">
            <x-admin-nav-label>アクセス管理</x-admin-nav-label>
        </li>
        <ul class="ml-4">
            @if(auth()->user()->isRouteAllowed('admin.route_role.index'))
            <li>
                <x-admin-nav-link :href="route('admin.route_role.index')" :active="request()->routeIs('admin.route-role.*')">
                    {{ __('models.route_role.table_name') }}
                </x-admin-nav-link>
            </li>
            @endif

            @if(auth()->user()->isRouteAllowed('admin.route_policy.index'))
            <li>
                <x-admin-nav-link :href="route('admin.route_policy.index')" :active="request()->routeIs('admin.route-policy.*')">
                    {{ __('models.route_policy.table_name') }}
                </x-admin-nav-link>
            </li>
            @endif
        </ul>
    </ul>
</div>
