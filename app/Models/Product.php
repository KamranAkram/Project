<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    // public function attributes(){
    //  return $this->belongsToMany(Attribute::class , 'product_attribute_values','product_id');
    // }


    public function categories()
    {
        return $this->belongsTo(Category::class , 'id' , 'cat_id');
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class , 'id' , 'sub_cat_id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class , 'id' , 'brand_id');
    }

    // public function values()
    // {
    //     return $this->belongsToMany(AttributeValue::class , 'product_attribute_values','product_id');
    // }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_product')
                    ->withPivot('attribute_value_id');
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}