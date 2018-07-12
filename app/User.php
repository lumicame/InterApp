<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(404, 'Esta acción no está autorizada.');
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function roles()
    {
        return $this
        ->belongsToMany('App\Role')
        ->withTimestamps();
    }

    public function school()
    {
         return $this->belongsTo('App\School');
    }

     public function classroom()
    {
         return $this->belongsTo('App\Classroom');
    }

     public function shedules()
    {
         return $this->hasMany('App\Shedule');
    }

    public function group()
    {
        return $this->belongsToMany('App\Classroom');
    }

public function profile()
    {
    
        return $this->hasOne('App\Profile');
    
    }
    

}
