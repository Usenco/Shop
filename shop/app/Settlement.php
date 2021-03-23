<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $fillable = [
        'citie',        'street', 'postomat',   'branch',
        'house_number', 'flat',   'created_at', 'updated_at',
        'post',         'where_in_post',        'citie_ref',
        'where'
    ];
}
