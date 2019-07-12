<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index($username)
    {
        $user = \App\User::where('username', $username)->firstOrFail();
        $surveys = $user->survey->chunk(1);
        return view('home', [
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
