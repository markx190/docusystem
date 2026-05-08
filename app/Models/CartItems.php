<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orders;
use App\Models\Item;

class CartItems extends Model
{
    protected $table = 'cart_items';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}