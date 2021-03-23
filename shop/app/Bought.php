<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    protected $fillable = [
        'idUser', 'idProduct', 'idSettl', 'Count',
        'Price',  'name',      'surname', 'phone', 
        'coments'
    ];

    public function boughtsettlement()
    {   
        return $this->hasOne(Settlement::class,'id','idSettl');
    }
    public function boughtproduct()
    {   
        return $this->hasOne(Product::class,'id','idProduct');
    } 
}
