<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Option;
use App\Question;
use App\QuestionOrder;
use App\Survey;

class OptionController extends Controller
{
    private $option;
    private $question;

    public function __construct(Option $option, Question $question)
    {
        $this->option = $option;
        $this->question = $question;
    }

    public function store(Request $request)
    {
        $questionId = $request->post('question_id');
        $options = \json_decode($request->post('options'));
        foreach ($options as $option) {
            DB::transaction(function () use ($questionId, $option) {
                $newOption = new Option();
                $newOption->content_op = $option;
                $newOption->question_id = $questionId;
                $newOption->save();
            });
        }
        $currentQuestion = $this->question->find($questionId);
        $survey_id = \App\QuestionOrder::where('question_id', $questionId)->first()->survey_id;
        $survey = \App\Survey::find($survey_id);
        return view('surveys.show', [
            'survey' => $survey
        ]);        

    }
}
