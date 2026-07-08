<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'category',
        'flag',
        'anonymous_name',
    ];

    public function replies()
    {
        return $this->hasMany(SupportReply::class);
    }

    public function votes()
    {
        return $this->hasMany(SupportPostVote::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}