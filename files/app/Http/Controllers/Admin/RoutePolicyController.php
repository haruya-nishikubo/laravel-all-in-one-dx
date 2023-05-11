<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoutePolicy\IndexRequest;
use App\Http\Requests\Admin\RoutePolicy\StoreRequest;
use App\Http\Requests\Admin\RoutePolicy\UpdateRequest;
use HaruyaNishikubo\AllInOneDx\Models\RoutePolicy;

class RoutePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $route_policies = $request->queryWithValidated()
            ->paginate(10);

        return view('admin.route_policy.index', [
            'route_policies' => $route_policies,
            'criteria' => $validated,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route_policy = new RoutePolicy;

        return view('admin.route_policy.create', [
            'route_policy' => $route_policy,
            'routes' => (new RoutePolicy())->targetRoutes(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $route_policy = new RoutePolicy($validated['route_policy']);

        if (! $route_policy->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_policy.show', $route_policy)
            ->with('success', 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  RoutePolicy  $route_policy
     * @return \Illuminate\Http\Response
     */
    public function show(RoutePolicy $route_policy)
    {
        return view('admin.route_policy.show', [
            'route_policy' => $route_policy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RoutePolicy  $route_policy
     * @return \Illuminate\Http\Response
     */
    public function edit(RoutePolicy $route_policy)
    {
        return view('admin.route_policy.edit', [
            'route_policy' => $route_policy,
            'routes' => (new RoutePolicy())->targetRoutes(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  RoutePolicy  $route_policy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, RoutePolicy $route_policy)
    {
        $validated = $request->validated();

        $route_policy->fill($validated['route_policy']);

        if (! $route_policy->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_policy.show', $route_policy)
            ->with('success', 'Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RoutePolicy  $route_policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoutePolicy $route_policy)
    {
        if (! $route_policy->delete()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_policy.index')
            ->with('success', 'Success.');
    }
}
