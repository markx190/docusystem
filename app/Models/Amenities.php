<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Amenities extends Model
{
    protected $table = 'amenities';
    protected $guarded = ['id'];

    // Define the relationship with Item
    public function wstudios()
    {
        return $this->belongsTo(WStudios::class, 'item_id_no', 'item_id_no');
    }
}