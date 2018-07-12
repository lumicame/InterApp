<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user()
    {
    
		return $this->belongsTo('App\User');
	
    }
    public function getLogoUrl()
{
    if ($this->avatar)
        return asset('logo/'.$this->avatar);

    return asset('logo/default.jpg');
}
public function getPortadaUrl()
{
    if ($this->portada)
        return asset('portada/'.$this->portada);

    return asset('portada/default.jpg');
}
public function deletefotos()
{
    \Storage::disk('logo')->delete($this->avatar);
    \Storage::disk('portada')->delete($this->portada);
}
}
