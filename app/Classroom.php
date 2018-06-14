<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function school()
    {
         return $this->belongsTo('App\School');
    }
    public function users()
	{
		return $this->hasMany('App\User');
	}
}
