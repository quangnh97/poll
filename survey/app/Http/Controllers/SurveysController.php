<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Question;
use App\Option;

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
            return \redirect('/home');
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
        auth()->user()->surveys()->where('id', $id)->update($data);
        return \redirect('/home');
    }

    public function destroy($id)
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        \App\QuestionOrder::where('survey_id', $id)->delete();
        \App\SurveyResponse::where('survey_id', $id)->delete();
        \App\Survey::where('id', $id)->delete();
        
        return \redirect('/home');
    }

    public function another()
    {
        if(auth()->user() == null) {
            return \redirect('/');
        }
        $surveys = \App\Survey::where('user_id', '<>', auth()->user()->id)->get();
        return view('surveys.another', [
            'surveys' => $surveys
        ]);
    }

    public function start($id)
    {
        $survey = \App\Survey::find($id);
        $surveyresponse = \App\SurveyResponse::where('survey_id', $id)->get();
        $flag = \App\SurveyResponse::where([
            ['survey_id', '=', $id],
            ['user_id', '=', auth()->user()->id]
        ])->first();
        if(empty($flag)){
            \App\SurveyResponse::create([
                'survey_id' => $id,
                'user_id' => auth()->user()->id
            ]);
        }

        // câu trả lời loại mulChoice
        $questionMul =
        DB::table('questions')
        ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
        ->join('options', 'questions.id', '=', 'options.question_id')
        ->where('question_orders.survey_id',$id)
        ->get()->toArray();
        foreach ($questionMul as $key => $value) {
            $value->options = Option::select('content_op')->where('question_id', $value->id)->get();
        }

        $question = DB::table('questions')
        ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
        ->where('question_orders.survey_id',$id)
        ->get();
        foreach ($question as $key => $value) {
            $value->options = Option::select('id', 'content_op')->where('question_id', $value->id)->get();
        }
        
        return view('surveys.start', [
            'survey' => $survey,
            'surveyresponse' => $surveyresponse,
            'questions' => $question,
            'questionMul' => $questionMul
        ]);
    }

    public function statistical($id)
    {
        $survey = \App\Survey::find($id);
       
        $surveyresponses = $survey->surveyresponses;
        //$statisticInfos = array();
        // foreach ($surveyresponses as $key => $surveyresponse) {
        //     $questions = \App\Response::distinct()->where('survey_response_id', $surveyresponse->id)
        //                                         ->get(['question_id']);
        //     if (count($questions) > 0) {
        //         foreach ($questions as $key1 => $question) {
        //             $chosenOfAnswer = $this->statisticByQuestion($question->question_id)[0]->answer;
        //             echo($chosenOfAnswer."<br>");
        //         }
        //     }
        //     array_push($statisticInfos, $questions);
        //   //  dem co cau hoi theo 1 surveyResponse
        //     if ($surveyresponse->response->question->type == 1) {
        //         echo($surveyresponse->response->groupBy('question_id')->count());
        //     }
        // }
        // dd($statisticInfos);
        // số người tham gia
        $number_of_participants = \App\SurveyResponse::where('survey_id', $id)->count();
        $number_of_participants =  $number_of_participants +1;
        // các câu hỏi trong survey
        $questions = DB::table('questions')
        ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
        ->where('question_orders.survey_id',$id)
        ->get();

        // MẢNG các câu trả lời
        $answers = array();
        foreach ($questions as  $question) {
            // các trả lời trong survey
             $id_question = $question->id;

            if($question->type == 3 ){
                $answer = DB::table('questions')
                ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
                ->join('responses', 'questions.id', '=', 'responses.question_id')
                ->join('users','users.id', '=' , 'responses.user_id')
                ->where('question_orders.survey_id',$id)
                ->selectRaw('answer, users.username')
                ->where('questions.id', $id_question)
                ->get();
            } else {
                $answer = DB::table('questions')
                ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
                ->join('responses', 'questions.id', '=', 'responses.question_id')
                ->where('question_orders.survey_id',$id)
                ->selectRaw('answer, count(*) as chosen')
                ->groupBy('answer')
                ->where('questions.id', $id_question)
                ->get();
            }
            $question->answer =$answer;


        }

      dd($questions);
       
        // $surveyarray = array($survey);
        // $responsearray = array();
    
        // foreach ($surveyresponse as $sr) {
        //     array_push($responsearray, $sr->response);
        // }

        // $data = array('survey' => $surveyarray, 'response' => $responsearray);
        // $data = \json_encode($data);
       return view('surveys.statistical', [
           'number_of_participants' => $number_of_participants,
            'survey' => $survey,
           'questions' => $questions,
       ]);
    }

    // public function statisticByQuestion($questionId)
    // {
    //     $question = \App\Question::find($questionId);
    //     $answers = \App\Response::selectRaw('answer, count(*) as chosen')
    //                                     ->groupBy('answer')
    //                                     ->where('question_id', $question->id)
    //                                     ->get();
    //     return $answers;
    // }

    public function detail($id)
    {
        $survey = \App\Survey::find($id);
        $surveyresponse = \App\SurveyResponse::where('survey_id', $id)->get();
        // $question = \App\Question::where('survey_id',$id)->get();
        $question = DB::table('questions')
        ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
        ->where('question_orders.survey_id',$id)
        ->get();
        foreach ($question as $key => $value) {
            $value->options = Option::select('id', 'content_op')->where('question_id', $value->id)->get();
        }

        //dd($question);
        // câu trả lời loại mulChoice
        $questionMul =
        DB::table('questions')
        ->join('question_orders', 'questions.id', '=', 'question_orders.question_id')
        ->join('options', 'questions.id', '=', 'options.question_id')
        ->where('question_orders.survey_id',$id)
        ->get()->toArray();
        foreach ($questionMul as $key => $value) {
            $value->options = Option::select('content_op')->where('question_id', $value->id)->get();
        }
        return view('surveys.detail', [
            'survey' => $survey,
            'surveyresponse' => $surveyresponse,
            'questions' => $question,
            'questionMul' => $questionMul
        ]);
    }
}
