<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveysController extends Controller
{
    public function create()
    {
        return view('surveys.create');
    }

    public function store()
    {
        $data = \request()->validate([
            'name' => ['required', 'unique:surveys', 'max:255'],
            'description' => ['required', 'max:1000']
        ]);

        auth()->user()->surveys()->create($data);

        dd(\request()->all());
    }
}
