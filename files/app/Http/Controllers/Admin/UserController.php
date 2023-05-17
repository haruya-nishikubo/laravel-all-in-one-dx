<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\IndexRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $validated = $request->validated();

        $users = $request->queryWithValidated()
            ->paginate(10);

        return view('admin.user.index', [
            'users' => $users,
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
        $user = new User;

        return view('admin.user.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $user = new User($validated['user']);
        $user->fill([
            'password' => $validated['user']['password'],
        ]);

        if (! $user->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.user.show', $user)
            ->with('success', 'Success.');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->fill($validated['user']);

        if (! $user->save()) {
            return back()->withInput()
                ->with('failure', 'Failure.');
        }

        return redirect()->route('admin.user.show', $user)
            ->with('success', 'Success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (! $user->delete()) {
            return back()->with('failure', 'Failure.');
        }

        return redirect()->route('admin.user.index')
            ->with('success', 'Success.');
    }
}
