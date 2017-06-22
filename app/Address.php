<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('addr1', 'addr2', 'city', 'state', 'postalCode', 'prefered');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function user() {
        return $this->belongsTo('User'); 
    }
	
	public function addType() {
		return $this->hasOne('AddType');
	}

    
}
