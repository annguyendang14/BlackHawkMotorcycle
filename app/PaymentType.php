<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    // MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
	protected $primaryKey = 'paymentType';
    protected $fillable = array('paymentType');

    // DEFINE RELATIONSHIPS --------------------------------------------------
}
