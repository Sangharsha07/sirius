<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('support_posts', function (Blueprint $table) {
            if (!Schema::hasColumn('support_posts', 'status')) {
                $table->string('status')->default('approved');
            }

            if (!Schema::hasColumn('support_posts', 'filter_reason')) {
                $table->text('filter_reason')->nullable();
            }
        });

        DB::table('support_posts')
            ->whereNull('status')
            ->update(['status' => 'approved']);
    }

    public function down(): void
    {
        Schema::table('support_posts', function (Blueprint $table) {
            if (Schema::hasColumn('support_posts', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('support_posts', 'filter_reason')) {
                $table->dropColumn('filter_reason');
            }
        });
    }
};