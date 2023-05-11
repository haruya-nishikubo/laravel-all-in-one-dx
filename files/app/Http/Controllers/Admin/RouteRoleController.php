<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RouteRole\IndexRequest;
use App\Http\Requests\Admin\RouteRole\StoreRequest;
use App\Http\Requests\Admin\RouteRole\UpdateRequest;
use HaruyaNishikubo\AllInOneDx\Models\RouteRole;

class RouteRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $route_roles = $request->queryWithValidated()
            ->paginate(10);

        return view('admin.route_role.index', [
            'route_roles' => $route_roles,
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
        $route_role = new RouteRole;

        return view('admin.route_role.create', [
            'route_role' => $route_role,
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

        $route_role = new RouteRole($validated['route_role']);

        if (! $route_role->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_role.show', $route_role)
            ->with('success', 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  RouteRole  $route_role
     * @return \Illuminate\Http\Response
     */
    public function show(RouteRole $route_role)
    {
        return view('admin.route_role.show', [
            'route_role' => $route_role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RouteRole  $route_role
     * @return \Illuminate\Http\Response
     */
    public function edit(RouteRole $route_role)
    {
        return view('admin.route_role.edit', [
            'route_role' => $route_role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  RouteRole  $route_role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, RouteRole $route_role)
    {
        $validated = $request->validated();

        $route_role->fill($validated['route_role']);

        if (! $route_role->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_role.show', $route_role)
            ->with('success', 'Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RouteRole  $route_role
     * @return \Illuminate\Http\Response
     */
    public function destroy(RouteRole $route_role)
    {
        if (! $route_role->delete()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('admin.route_role.index')
            ->with('success', 'Success.');
    }
}
