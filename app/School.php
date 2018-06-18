<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
	public function users()
	{
		return $this->hasMany('App\User');
	}

	public function classrooms()
	{
		return $this->hasMany('App\Classroom');
	}

	public function subjects()
	{
		return $this->hasMany('App\Subject');
	}
	
}
