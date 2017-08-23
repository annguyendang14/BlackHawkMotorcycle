<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemDate extends Model
{
	// MASS ASSIGNMENT -------------------------------------------------------
    // define which attributes are mass assignable (for security)
    protected $table = 'systemdate';
    protected $fillable = array('year', 'open_register', 'conference_start', 'conference_end');
}