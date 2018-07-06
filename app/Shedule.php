<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    public function classroom()
    {
         return $this->belongsTo('App\Classroom');
    }
    public function dates()
    {
         return $this->hasMany('App\Date');
    }
    public function user()
    {
         return $this->belongsTo('App\User');
    }
 	 public function subject()
    {
         return $this->belongsTo('App\Subject');
    }
    public function evaluations()
    {
         return $this->hasMany('App\Evaluation');
    }
     
}
