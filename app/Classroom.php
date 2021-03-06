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
	public function grade()
	{
		return $this->belongsTo('App\Grade');
	}
	 public function shedules()
	{
		return $this->hasMany('App\Shedule');
	}
	public function director()
	{
		return $this->belongsToMany('App\User');
	}
}
