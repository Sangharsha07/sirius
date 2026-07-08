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
        Schema::create('support_replies', function (Blueprint $table) {
            $table->id();

            $table->foreignId('support_post_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('reply');
            $table->string('anonymous_name')->default('Anonymous Student');

            // moderation result
            $table->string('status')->default('approved');
            // approved, blocked, review

            $table->string('filter_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_replies');
    }
};
