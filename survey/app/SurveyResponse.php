<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
