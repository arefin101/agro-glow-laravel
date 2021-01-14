<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notifications';
	protected $primaryKey = "id";
	public $timestamps = false;
}
