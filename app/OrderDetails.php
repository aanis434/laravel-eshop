<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
	protected $fillable = [
		'order_id',
		'product_id',
		'unit',
		'price',
		'qty',
		'discount',
		'total_price',
		'status',
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function unit()
	{
		return $this->belongsTo(Unit::class);
	}
}
