<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orders;
use App\Models\Item;

class ItemsOrdered extends Model
{
    protected $table = 'items_ordered';
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}