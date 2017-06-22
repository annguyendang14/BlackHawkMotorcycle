<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceOrderLine extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $table = 'spaceorderline';
    protected $fillable = array('order_id', 'space_id', 'price');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function order() {
        return $this->belongsTo('Order'); 
    }
	
	public function space() {
		return $this->belongsTo('Space');
	}
}
