<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['order_id', 'product_id', 'user_id', 'amount'];
    public $primaryKey = 'order_id';

    public $timestamps = false;
}
