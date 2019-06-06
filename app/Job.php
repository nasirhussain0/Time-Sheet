<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function Sessions()
    {
        return $this->hasMany('App\Session');
    }
}
