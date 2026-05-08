<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Orders extends Model
{
    protected $table = 'orders';
    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(ItemsOrdered::class, 'item_id_no', 'item_id_no');
    }
}