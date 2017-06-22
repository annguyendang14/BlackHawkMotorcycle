<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	protected $primaryKey = 'phoneType';
	public $incrementing = false;
	protected $table = 'phonetypes';
    protected $fillable = array('phoneType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
}
