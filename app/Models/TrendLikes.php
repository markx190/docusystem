<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrendLikes extends Model
{
    protected $table = 'trend_likes';

    protected $fillable = [
        'topic_id',
        'client_id_no',
        'topic_owner',
        'type'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function trend()
    {
        return $this->belongsTo(Trends::class, 'topic_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isUpvote()
    {
        return $this->type === 'up';
    }

    public function isDownvote()
    {
        return $this->type === 'down';
    }

}