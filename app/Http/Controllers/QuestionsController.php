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
        //dd(auth()->user()->email);
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

    public function update(Request $request, $id)
    {
        $survey_id = \App\QuestionOrder::where('question_id', $id)->first()->survey_id;
        return view('questions.options',[
            'content' =>  $request->content,
            'question_id' => $id
        ]);    
    }

       public function show(Request $request,$id)
    {   
        \App\Option::create(
            ['content_op' => $request->a,'question_id' => $id]  
        );
        \App\Option::create(
            ['content_op' => $request->b,'question_id' => $id]  
        );
        \App\Option::create(
            ['content_op' => $request->c,'question_id' => $id] 
        );
        \App\Option::create(
            ['content_op' => $request->d,'question_id' => $id] 
        );
        $survey_id = \App\QuestionOrder::where('question_id', $id)->first()->survey_id;
        $survey = \App\Survey::find($survey_id);
            return view('surveys.show', [
                'survey' => $survey
            ]);
    }



}
