<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
	protected $primaryKey = "id";
	public $timestamps = false;
}

