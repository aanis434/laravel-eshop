<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\OrderDetails;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'uuid',
        'amount',
        'discount',
        'discount_type',
        'delivery_charge',
        'total_amount',
        'notes',
        'payment_type',
        'payment_status',
        'order_no',
        'updated_by',
        'status',
    ];

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(BillingAddress::class);
    }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class);
    }
}
