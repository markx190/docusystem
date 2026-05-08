<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ItemImages extends Model
{
    protected $table = 'items_images';
    protected $guarded = ['id'];

    // Define the relationship with Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id_no', 'item_id_no');
    }
}