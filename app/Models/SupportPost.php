<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportPost extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category',
        'anonymous_name',
    ];

    public function replies()
    {
        return $this->hasMany(SupportReply::class);
    }
}