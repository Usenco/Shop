<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usersproductsfavorit extends Model
{
    public function products()
    {
        return $this->hasOne(Product::class,'idProduct','id');
    }
    public function users()
    {
        return $this->hasOne(User::class,'idUser','id');
    }
}
