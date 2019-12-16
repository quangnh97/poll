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
        \App\Response::where('question_id',$id)->delete();
        \App\Question::where('id', $id)->delete();
        
        return \redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $survey_id = \App\QuestionOrder::where('question_id', $id)->first()->survey_id;
 
        if(auth()->user() == null) {
            return \redirect('/');
        }
        
        $data = \request()->validate([
            'content' => ['required', 'max:255'],
            
        ]);
        \App\Question::where('id', $id)->update($data);
        return \redirect()->back();
    }

    public function options(Request $request, $id) {
        
        return view('questions.options',[
            'content' =>  $request->content,
            'question_id' => $id
        ]);
    }

    public function optionsPicture (Request $request, $id) {
        
        return view('questions.options-picture',[
            'content' =>  $request->content,    
            'question_id' => $id
        ]);
    }

       public function show(Request $request,$id)
    {   
        // $flag = \App\Option::where([
        //     ['question_id', $survey_response_id],
        // ])->first();
        // if(empty($flag)) {
        //     \App\Response::create([
        //         'survey_response_id' => $survey_response_id,
        //         'question_id' => $question_id,
        //         'user_id' => $user->id, 
        //         'answer' => $answer
        //     ]);
        // } else {
        //     \App\Response::where([
        //         ['survey_response_id', $survey_response_id],
        //         ['question_id', $question_id],
        //         ['user_id', $user->id]
        //     ])->update(['answer' => $answer]);
        // }

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
