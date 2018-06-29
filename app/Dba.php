<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dba extends Model
{
   public function subject()
    {
         return $this->belongsTo('App\Subject');
    }
    public function grade()
    {
         return $this->belongsTo('App\Grade');
    }
     function questions()
    {
    	return $this->hasMany('App\Question');
    }
}
