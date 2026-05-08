<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class RoutesTerminal extends Model
{
    protected $table = "routes_terminal";
	protected $guarded = ['id'];

}