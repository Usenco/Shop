<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    public function get_Product()
    {
        return $this->hasOne(Product::class,"id","id");
    }
}
