<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuestionsController extends Controller
{
    public function index()
    {
        return view('questions.index');
    }

    public function create()
    {
        return view('questions.create', [
            'survey' => \request()->survey
        ]);
    }

    public function store()
    {
        $data = \request()->validate([
            'content' => ['required', 'max:255'],
            'type' => 'required'
        ]);
        
        \App\Question::create($data);
        \App\QuestionOrder::create([
            'survey_id' => request()->survey,
            'question_id' => DB::table('questions')->orderby('created_at', 'desc')->first()->id
        ]);

        return \redirect('/home/' . \auth()->user()->username);
    }
}
