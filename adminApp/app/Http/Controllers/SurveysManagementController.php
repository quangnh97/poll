<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Survey;
use App\QuestionOrder;
class SurveysManagementController extends Controller
{
    public function index()
    {
            $surveys = \App\Survey::select('surveys.id','name','users.username')
            ->join('users', 'users.id', '=', 'surveys.user_id')
            ->get();    
            return view('admin.surveys-management', [
                'surveys' => $surveys
            ]);
    }

    public function destroy($id)
    {   
        \App\QuestionOrder::where('survey_id', $id)->delete();
        \App\Survey::where('id', $id)->delete();

        return \redirect()->back();
    }
}
