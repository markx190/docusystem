<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class FileHistory extends Model
{
    protected $table = "file_history";
	protected $guarded = ['id'];

}