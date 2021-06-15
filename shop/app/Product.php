<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use UsersProductsFavorit;

class Product extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['id','title','description','price','arrived_time','keywords','idCategory','mainimg'];
    public function images()
    {
        return $this->hasMany(Productsimage::class,'idProduct','id');
    }
    public function get_value()
    {
        return $this->hasMany(Value::class,"id","id");
    }
}
