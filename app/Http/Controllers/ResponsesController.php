<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ResponsesController extends Controller
{
    public function store()
    {
        $user = auth()->user();
        if($user == null) {
            return \redirect('/');
        }
        $request = \request()->all();

        $answers = array();
        foreach ($request as $key => $value) {
            if(\is_numeric($key)){
                $answers[$key] = $value;
            }
        }
        $survey_response_id = DB::table('survey_responses')->latest('updated_at')->first()->id;
        foreach ($answers as $question_id => $answer) {
            $flag = \App\Response::where([
                ['survey_response_id', $survey_response_id],
                ['question_id', $question_id],
                ['user_id', $user->id]
            ])->first();
            if(empty($flag)) {
                \App\Response::create([
                    'survey_response_id' => $survey_response_id,
                    'question_id' => $question_id,
                    'user_id' => $user->id,
                    'answer' => $answer
                ]);
            } else {
                \App\Response::where([
                    ['survey_response_id', $survey_response_id],
                    ['question_id', $question_id],
                    ['user_id', $user->id]
                ])->update(['answer' => $answer]);
            }
        }
        return view('surveys.thanks');
    }
}
