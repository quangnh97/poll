<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) 
    {
        dd($request);
        return view('users.review', [
            
        ]);
    }
}
