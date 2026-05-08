<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Buses extends Model
{
    protected $table = "buses";
	protected $guarded = ['id'];

}