<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function surveys()
    {
        return $this->belongsToMany(Survey::class, 'question_orders', 'survey_id', 'question_id');
    }

    public function option()
    {
        return $this->hasMany('App\Option','id','question_id');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
