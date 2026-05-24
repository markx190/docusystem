<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Trends extends Model
{
    protected $table = "trends";
	protected $guarded = ['id'];

    public function likes()
    {
        return $this->hasMany(
            TrendLikes::class,
            'topic_id'
        );
    }


    public function getScoreAttribute()
    {
        $upvotes = $this->likes()
            ->where('type', 'up')
            ->count();

        $downvotes = $this->likes()
            ->where('type', 'down')
            ->count();

        return $upvotes - $downvotes;
    }
}