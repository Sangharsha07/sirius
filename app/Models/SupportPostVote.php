<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportPostVote extends Model
{
    protected $fillable = [
        'support_post_id',
        'user_id',
        'vote',
    ];

    public function post()
    {
        return $this->belongsTo(SupportPost::class, 'support_post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}