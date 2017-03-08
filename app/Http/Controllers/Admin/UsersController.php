<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
           'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {

    }

    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function promoteAdmin(User $user)
    {
        if( $user->isAdmin() )
            abort(404);

        $user->attachRole(Role::whereName('admin')->firstOrFail());

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }

    public function demoteAdmin(User $user)
    {
        if( !$user->isAdmin() )
            abort(404);

        $user->detachRole(Role::whereName('admin')->firstOrFail());

        return redirect()->route('admin.users.show', [
            'user' => $user
        ]);
    }
}