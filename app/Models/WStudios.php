<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WStudios extends Model
{
    protected $table = 'wstudios';
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(ItemImages::class, 'item_id_no', 'item_id_no');
    }
    
    public function facility()
    {
        return $this->hasMany(facilites::class, 'item_id_no', 'item_id_no');
    }
    
    public function amenites()
    {
        return $this->hasMany(amenities::class, 'item_id_no', 'item_id_no');
    }
}