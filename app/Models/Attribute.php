<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    // public function values(){
    //     return $this->hasMany(AttributeValue::class , 'attribute_id');
    // }
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_attribute_values', 'product_id', 'attribute_id');
    // }
    public function products()
    {
        return $this->belongsToMany(Product::class)->using(AttributeProduct::class)->withPivot('attribute_value_id');
    }
}
