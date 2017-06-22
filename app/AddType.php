<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddType extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	protected $primaryKey = 'addType';
	public $incrementing = false;
	protected $table = 'addresstypes';
    protected $fillable = array('addType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
    
    
}
