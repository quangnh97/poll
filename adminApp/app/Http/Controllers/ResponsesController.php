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
        $requestParams = \request()->all();
        
        // câu trả lời của câu hỏi mulChoice
        $id_mul_answers = explode('_',$requestParams["q_as"]);
        array_splice($id_mul_answers, 0, 1);



        foreach ($id_mul_answers as $id_mul_answer) {
            $flagg = \App\Option::find($id_mul_answer);
             //$answers[$flag['question_id']] = $flag['content_op'];
             $survey_response_id = DB::table('survey_responses')->latest('updated_at')->first()->id;
             if(isset($flagg)) {
                \App\Response::create([
                    'survey_response_id' => $survey_response_id,
                    'question_id' => $flagg['question_id'],
                    'user_id' => $user->id, 
                    'answer' => $flagg['content_op']
                ]);
            }
        }
        $answers = array(); 
        foreach ($requestParams as $key => $value) {
            if(\is_numeric($key)){
                $answers[$key] = $value;
            }
        }
       // dd( $answers);
        $survey_response_id = DB::table('survey_responses')->latest('updated_at')->first()->id;
        foreach ($answers as $question_id => $answer) {
            $flag = \App\Response::where([
                ['survey_response_id', $survey_response_id],
                ['question_id', $question_id],
                ['user_id', $user->id]
            ]);
            //dd($flag);
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


