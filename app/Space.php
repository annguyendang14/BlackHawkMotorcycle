<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('row', 'col', 'note', 'price', 'availability','user_id');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function user() {
        return $this->belongsTo('App\User'); 
    }
	
	public function spaceLine() {
        return $this->hasMany('App\SpaceOrderLine'); 
    }
	
}
