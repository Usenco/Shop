<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    protected $fillable = [
        'id', 'caption' , 'description', 'id_categorie'
    ];

    public function get_values()
    {
        return $this->hasMany(Value::class,"id_characteristics","id");
    }
}
