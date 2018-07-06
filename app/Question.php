<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   public function dba()
    {
         return $this->belongsTo('App\Dba');
    }
    public function evaluation()
    {
         return $this->belongsTo('App\Evaluation');
    }
}
