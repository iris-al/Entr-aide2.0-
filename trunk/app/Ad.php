<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function usr(){
        return $this->belongsTo('App\User');
        }
}
