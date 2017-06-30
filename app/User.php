<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Address;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'middleInitial', 'Nickname' ,'CompanyName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'password', 'remember_token'
    ];
	
	public function address(){
		return $this->hasMany('App\Address');
	}
	
	public function phone(){
		return $this->hasMany('App\Phone');
	}
	
	public function space(){
		return $this->hasMany('App\Space');
	}
}
