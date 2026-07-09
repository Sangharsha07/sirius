<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Journal extends Model
{
    // Allow mass assignment for these columns
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'is_public'
    ];

    /**
     * Get the user that owns the journal entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}