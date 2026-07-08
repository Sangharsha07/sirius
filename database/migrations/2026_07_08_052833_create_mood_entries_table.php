<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mood_entries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('mood');
            $table->integer('stress_level');
            $table->integer('energy_level');
            $table->string('trigger')->nullable();
            $table->date('entry_date');
            $table->text('note')->nullable();

            $table->boolean('used_ai_suggestion')->default(false);
            $table->string('ai_suggested_mood')->nullable();
            $table->integer('ai_suggested_stress')->nullable();
            $table->integer('ai_suggested_energy')->nullable();
            $table->string('ai_suggested_trigger')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_entries');
    }
};