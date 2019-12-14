<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    protected $fillable = ['content_op','question_id'];


    public function question()
    {
        return $this->belongsTo('App\Question','id','question_id');
    }
}
