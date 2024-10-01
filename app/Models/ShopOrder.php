<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'payment_method',
        'address_id',
        'order_total',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id','id');
    }
}