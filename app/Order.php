<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('paymentType', 'status', 'total_price', 'unpaid_price', 'user_id');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function user() {
        return $this->belongsTo('App\User'); 
    }
	
	public function paymentType() {
		return $this->hasOne('App\PaymentType');
	}
	
	public function spaceLine() {
		return $this->hasMany('App\SpaceOrderLine');
	}
	
	public function productLine() {
		return $this->hasMany('App\ProductOrderLine');
	}
}
