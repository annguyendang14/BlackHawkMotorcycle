<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrderLine extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $table = 'productorderline';
    protected $fillable = array('order_id', 'product_id', 'price', 'quantity', 'address_id');
	// IMPORTANT: if implement product, need a separate address shipping table instead of using user address table (incase user want to delete address, the order information will not be changed)
    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    public function order() {
        return $this->belongsTo('App\Order'); 
    }
	
	public function product() {
		return $this->belongsTo('App\Product');
	}
}
