<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
     public function classroom()
	{
		return $this->hasMany('App\Classroom');
	}
	function dbas()
    {
    	return $this->hasMany('App\Dba');
    }
}
