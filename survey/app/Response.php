<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function surveyresponse()
    {
        return $this->belongsTo(SurveyResponse::class);
    }
}
