<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password', 'profilePic', 'registerDate','admin','payRate', 'numOfHolidays',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Sessions()
    {
        return $this->hasMany('App\Session', 'userId');
    }

    public function Holidays()
    {
        return $this->hasMany('App\Holiday');
    }
    
    public function Expenses()
    {
        return $this->hasMany('App\Expense');
    }

      public function isAdmin(){
        return $this->admin;
    }
}
