<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	protected $primaryKey = 'paymentType';
	protected $table = 'paymenttypes';
	public $incrementing = false;
    protected $fillable = array('paymentType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
}
