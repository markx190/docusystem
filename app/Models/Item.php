<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Item extends Model
{
    protected $table = 'items';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(ItemImages::class, 'item_id_no', 'item_id_no');
    }
}