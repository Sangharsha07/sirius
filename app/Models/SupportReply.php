<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    protected $fillable = [
        'support_post_id',
        'reply',
        'anonymous_name',
        'status',
        'filter_reason',
    ];

    public function post()
    {
        return $this->belongsTo(SupportPost::class, 'support_post_id');
    }
}