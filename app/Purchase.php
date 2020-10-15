<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'uuid',
        'memo_no',
        'total_price',
        'tax',
        'discount_type',
        'discount',
        'total_amount',
        'paid_amount',
        'due_amount',
        'advance_amount',
        'amt_to_pay',
        'file',
        'notes',
        'invoice_no',
        'supplier_id',
        'created_by',
        'updated_by',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }
}
