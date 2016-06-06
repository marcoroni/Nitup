<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['product_id', 'name', 'description', 'category', 'price'];

    public $timestamps = false;

    public $primaryKey = 'product_id';
}
