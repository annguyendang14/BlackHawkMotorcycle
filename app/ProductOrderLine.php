<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrderLine extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $table = 'productorderline';
    protected $fillable = array('order_id', 'product_id', 'price', 'quantity', 'address_id');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function order() {
        return $this->belongsTo('App\Order'); 
    }
	
	public function product() {
		return $this->belongsTo('App\Product');
	}
}
