<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StockReport extends Model
{

    protected $table = 'stock_reports';

    protected $guarded = [];

    protected static $logAttributes = ['*'];
    protected static $recordEvents = ['updated', 'deleted'];


    public function setOpeningStockAttribute($value)
    {
        $this->attributes['opening_stock'] = round($value, 2);
    }
    public function setPurchaseQtyAttribute($value)
    {
        $this->attributes['purchase_qty'] = round($value, 2);
    }
    public function setSaleQtyAttribute($value)
    {
        $this->attributes['sale_qty'] = round($value, 2);
    }

    public function setPurchaseReturnQtyAttribute($value)
    {
        $this->attributes['purchase_return_qty'] = round($value, 2);
    }
    public function setSaleReturnQtyAttribute($value)
    {
        $this->attributes['sale_return_qty'] = round($value, 2);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }
}
