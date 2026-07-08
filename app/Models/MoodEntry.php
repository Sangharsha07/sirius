<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    protected $fillable = [
        'user_id',
        'mood',
        'stress_level',
        'energy_level',
        'trigger',
        'entry_date',
        'note',
        'used_ai_suggestion',
        'ai_suggested_mood',
        'ai_suggested_stress',
        'ai_suggested_energy',
        'ai_suggested_trigger',
    ];
}