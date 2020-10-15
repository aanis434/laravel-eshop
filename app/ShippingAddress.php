<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShippingAddress extends Model
{
    protected $fillable = [
		'name',
		'uuid',
    	'phone',
    	'alternative_phone',
    	'address',
    	'order_id',
    	'status',
    ];

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }
}
