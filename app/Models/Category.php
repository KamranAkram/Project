<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subcategories(){
        return $this->hasMany(SubCategory::class , 'cat_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class , 'id','cat_id');
    }
}
