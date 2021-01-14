<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productPurchased extends Model
{
    protected $table = 'product_purchased';
	protected $primaryKey = "id";
	public $timestamps = false;

	protected $fillable = ['name', 'category', 'quantity', 'price'];
}
