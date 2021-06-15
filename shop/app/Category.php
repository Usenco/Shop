<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function get_characteristics()
    {
        return $this->belongsToMany(
            Characteristic::class,
            'category_characteristics',
            'idCategory',
            'idCharacteristic');
    }
}
