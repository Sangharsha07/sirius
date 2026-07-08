<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('support_post_votes')) {
            Schema::table('support_post_votes', function (Blueprint $table) {
                if (!Schema::hasColumn('support_post_votes', 'vote')) {
                    $table->tinyInteger('vote')->default(0);
                }
            });
        }

        if (Schema::hasTable('support_reply_votes')) {
            Schema::table('support_reply_votes', function (Blueprint $table) {
                if (!Schema::hasColumn('support_reply_votes', 'vote')) {
                    $table->tinyInteger('vote')->default(0);
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('support_post_votes')) {
            Schema::table('support_post_votes', function (Blueprint $table) {
                if (Schema::hasColumn('support_post_votes', 'vote')) {
                    $table->dropColumn('vote');
                }
            });
        }

        if (Schema::hasTable('support_reply_votes')) {
            Schema::table('support_reply_votes', function (Blueprint $table) {
                if (Schema::hasColumn('support_reply_votes', 'vote')) {
                    $table->dropColumn('vote');
                }
            });
        }
    }
};