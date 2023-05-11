<?php

namespace App\Http\Controllers\Admin\RouteRole;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RouteRole\User\StoreRequest;
use App\Models\User;
use HaruyaNishikubo\AllInOneDx\Models\RouteRole;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  RouteRole  $route_role
     * @return Response
     */
    public function create(RouteRole $route_role)
    {
        return view('admin.route_role.user.create', [
            'route_role' => $route_role,
            'users' => User::cursor(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @param  RouteRole  $route_role
     * @return Response
     */
    public function store(StoreRequest $request, RouteRole $route_role)
    {
        $validated = $request->validated();

        $route_role->users()
            ->sync($validated['route_role']['users'] ?? []);

        return redirect()->route('admin.route_role.show', $route_role)
            ->with('success', 'Success.');
    }
}
