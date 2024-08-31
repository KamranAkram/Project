<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeProduct extends Pivot
{
    public function values()
    {
        return $this->hasOne(AttributeValue::class, 'id', 'attribute_value_id');
    }
}
