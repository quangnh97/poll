<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveysController extends Controller
{
    public function create()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        return view('surveys.create');
    }

    public function store()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            $data = \request()->validate([
                'name' => ['required', 'unique:surveys', 'max:255'],
                'description' => ['required', 'max:1000']
            ]);
            auth()->user()->surveys()->create($data);
            return \redirect('/home/' . \auth()->user()->username);
        }
    }

    public function show($id)
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            $survey = \App\Survey::find($id);
            return view('surveys.show', [
                'survey' => $survey
            ]);
        }
    }
    
    public function update($id)
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        $data = \request()->validate([
            'name' => ['required', 'unique:surveys', 'max:255'],
            'description' => ['required', 'max:1000']
        ]);
        auth()->user()->surveys()->update($data);
        return \redirect('/home/' . \auth()->user()->username);
    }

    public function destroy($id)
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        \App\QuestionOrder::where('survey_id', $id)->delete();
        \App\Survey::where('id', $id)->delete();
        return \redirect('/home/' . \auth()->user()->username);
    }
}
