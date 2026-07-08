<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('support_post_votes')) {
            Schema::create('support_post_votes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('support_post_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->tinyInteger('vote')->default(0);
                $table->timestamps();
            });
        } else {
            Schema::table('support_post_votes', function (Blueprint $table) {
                if (!Schema::hasColumn('support_post_votes', 'support_post_id')) {
                    $table->unsignedBigInteger('support_post_id')->nullable();
                }

                if (!Schema::hasColumn('support_post_votes', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }

                if (!Schema::hasColumn('support_post_votes', 'vote')) {
                    $table->tinyInteger('vote')->default(0);
                }
            });
        }

        if (!Schema::hasTable('support_reply_votes')) {
            Schema::create('support_reply_votes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('support_reply_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->tinyInteger('vote')->default(0);
                $table->timestamps();
            });
        } else {
            Schema::table('support_reply_votes', function (Blueprint $table) {
                if (!Schema::hasColumn('support_reply_votes', 'support_reply_id')) {
                    $table->unsignedBigInteger('support_reply_id')->nullable();
                }

                if (!Schema::hasColumn('support_reply_votes', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }

                if (!Schema::hasColumn('support_reply_votes', 'vote')) {
                    $table->tinyInteger('vote')->default(0);
                }
            });
        }
    }

    public function down(): void
    {
        // Leave empty so we do not accidentally delete vote data.
    }
};