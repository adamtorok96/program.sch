<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function ajax()
    {
        $users = User::orderBy('name')->get();

        return response()->json($users);
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
}