<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
	protected $fillable = [
		'purchase_id',
		'product_id',
		'price',
		'qty',
		'total_price',
		'unit_id',
		'notes',
		'current_stock',
		'last_purchase_qty',
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
