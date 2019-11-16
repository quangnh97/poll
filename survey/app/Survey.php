<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_orders', 'survey_id', 'question_id');
    }

    public function surveyresponses()
    {
        return $this->hasMany(SurveyResponse::class);
    }
}
