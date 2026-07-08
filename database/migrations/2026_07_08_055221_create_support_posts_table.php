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
        Schema::create('support_posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('body');
            $table->string('category')->nullable();

            // anonymous board, so name is optional
            $table->string('anonymous_name')->default('Anonymous Student');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_posts');
    }
};
