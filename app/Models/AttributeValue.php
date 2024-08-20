<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    public function attributes()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attribute_value', 'attribute_value_id');
    }
}