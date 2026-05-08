<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orders;
use App\Models\Item;

class BzTransactions extends Model
{
    protected $table = 'bz_transactions';
    protected $guarded = ['id'];

}