<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'country_id',
        'address',
        'apartment',
        'city',
        'region',
        'zip',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'address_users');
    }



    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function order()
    {
        return $this->hasMany(ShopOrder::class);
    }
}