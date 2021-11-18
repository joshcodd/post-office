<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function generateToken()
    {
        /** @var \App\Models\User $user **/
        $user = Auth::User();
        $token = $user->createToken('api_token');
        return ['token' => $token->plainTextToken];
    }

    public function showMyProfile()
    {
        $user = User::findOrFail(Auth::User()->id);
        return view('users.show', ['user' => $user]);
    }

    public function notifications()
    {
        return view('notifications.index');
    }

    public function clearNotifications()
    {
        Auth::User()->notifications->markAsRead();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }
}