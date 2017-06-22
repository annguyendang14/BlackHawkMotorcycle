<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
   
    protected $fillable = array('price', 'description', 'in stock');
	public $incrementing = false;

    
}
