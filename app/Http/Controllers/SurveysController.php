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

        return \redirect('/home/' . \auth()->user()->username);
    }

    public function show($id)
    {
        $survey = \App\Survey::find($id);
        return view('surveys.show', [
            'survey' => $survey
        ]);
    }
    
    public function update($id)
    {
        $data = \request()->validate([
            'name' => ['required', 'unique:surveys', 'max:255'],
            'description' => ['required', 'max:1000']
        ]);

        auth()->user()->surveys()->update($data);

        return \redirect('/home/' . \auth()->user()->username);
    }

    public function destroy($id)
    {
        \App\QuestionOrder::where('survey_id', $id)->delete();
        \App\Survey::where('id', $id)->delete();
        return \redirect('/home/' . \auth()->user()->username);
    }
}
