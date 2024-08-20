<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class , 'id','sub_cat_id');
    }
}
