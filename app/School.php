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
	public function getLogoUrl()
{
    if ($this->logo)
        return asset('logo/'.$this->logo);

    return asset('logo/default.jpg');
}
public function getPortadaUrl()
{
    if ($this->portada)
        return asset('portada/'.$this->portada);

    return asset('portada/default.jpg');
}
	
}
