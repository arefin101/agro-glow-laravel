<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productRequest extends Model
{
    protected $table = 'product_requests';
	protected $primaryKey = "id";
	public $timestamps = false;

	protected $fillable = ['user', 'category', 'productName', 'quantity', 'price', 'approval'];
}
