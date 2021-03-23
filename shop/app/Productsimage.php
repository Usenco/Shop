<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productsimage extends Model
{
    public $timestamps = FALSE;
    public function products()
    {
        return $this->hasOne(Product::class,'id','idProduct');
    }
}
