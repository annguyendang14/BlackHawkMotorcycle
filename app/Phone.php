<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('number', 'prefered');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function user() {
        return $this->belongsTo('User'); 
    }
	
	public function phoneType() {
		return $this->hasOne('PhoneType');
	}
}
