<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StockHistory extends Model
{
    protected $guarded = [];

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = Str::uuid();
    }
}
