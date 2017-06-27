<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('addr1', 'addr2', 'city', 'state', 'country', 'postalCode', 'prefered', 'user_id', 'addType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function user() {
        return $this->belongsTo('App\User'); 
    }
	
	public function addType() {
		return $this->hasOne('App\AddType');
	}

    
}
