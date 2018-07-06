<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function shedule()
    {
         return $this->belongsTo('App\Shedule');
    }
    public function questions()
    {
         return $this->hasMany('App\Question');
    }
}
