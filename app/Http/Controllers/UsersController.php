<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index($username)
    {
        $user = \App\User::where('username', $username)->firstOrFail();
        $surveys = $user->surveys->chunk(1);
        return view('users.index', [
            'user' => $user,
            'surveys' => $surveys
        ]);
    }
    // public function index()
    // {
    //     // $user = Auth::user();
    //     return view('home');
    // }
}
