<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	protected $primaryKey = 'phoneType';
    protected $fillable = array('phoneType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
}
