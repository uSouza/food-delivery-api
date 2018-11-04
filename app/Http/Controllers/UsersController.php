<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function findUserByEmail($email)
    {
        return User::where('email', '=', $email)->with('client')->firstOrfail();
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        $user->update($data);
        return $user;
    }

    public function setOneSignalId(Request $request)
    {
        $user = auth()->user();
        $user->onesignal_id = $request->input('player_id');
        $user->save();
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $user;
    }

    public function me(Request $request)
    {
        return User::where('id', '=', $request->user()->id)->with('client')->firstOrfail();
    }
}
