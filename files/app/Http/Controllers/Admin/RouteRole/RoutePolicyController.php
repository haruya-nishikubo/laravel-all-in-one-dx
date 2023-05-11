<?php

namespace App\Http\Controllers\Admin\RouteRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RouteRole\RoutePolicy\StoreRequest;
use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;
use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use Illuminate\Http\Response;

class RoutePolicyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  RouteRole  $route_role
     * @return Response
     */
    public function create(RouteRole $route_role)
    {
        return view('admin.route_role.route_policy.create', [
            'route_role' => $route_role,
            'route_policies' => RoutePolicy::cursor(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, RouteRole $route_role)
    {
        $validated = $request->validated();

        $route_role->routePolicies()
            ->sync($validated['route_role']['route_policies'] ?? []);

        return redirect()->route('admin.route_role.show', $route_role)
            ->with('success', 'Success.');
    }
}
