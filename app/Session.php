<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Expenses()
    {
        return $this->hasMany('App\Expense');
    }

    public function Jobs()
    {
        return $this->hasMany('App\Job');
    }

    public function Job()
    {
        return $this->belongsTo('App\Job');
    }

}
