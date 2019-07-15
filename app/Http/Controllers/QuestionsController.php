<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class QuestionsController extends Controller
{
    public function index()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            return view('questions.index');
        }
    }

    public function create()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            return view('questions.create', [
                'survey' => \request()->survey
            ]);
        }
    }

    public function store()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        } else {
            $data = \request()->validate([
                'content' => ['required', 'max:255'],
                'type' => 'required'
            ]);
            \App\Question::create($data);
            \App\QuestionOrder::create([
                'survey_id' => request()->survey,
                'question_id' => DB::table('questions')->orderby('created_at', 'desc')->first()->id
            ]);

            return \redirect('/surveys/' . \request()->survey);
        }
    }

    public function destroy($id)
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        \App\QuestionOrder::where('question_id', $id)->delete();
        \App\Question::where('id', $id)->delete();
        return \redirect()->back();
    }
}
