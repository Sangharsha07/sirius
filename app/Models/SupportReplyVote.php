<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportReplyVote extends Model
{
    protected $fillable = [
        'support_reply_id',
        'user_id',
        'vote',
    ];

    public function reply()
    {
        return $this->belongsTo(SupportReply::class, 'support_reply_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}