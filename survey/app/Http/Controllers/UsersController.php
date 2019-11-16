<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \App\User::where('username', auth()->user()->username)->firstOrFail();
        $surveys = $user->surveys->chunk(1);
        return view('users.index', [
            'user' => $user,
            'surveys' => $surveys
        ]);
    }
}
