<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
   public function school()
    {
         return $this->belongsTo('App\School');
    }

      public function shedules()
    {
         return $this->hasMany('App\Shedule');
    }

    function dbas()
    {
    	return $this->hasMany('App\Dba');
    }
}
