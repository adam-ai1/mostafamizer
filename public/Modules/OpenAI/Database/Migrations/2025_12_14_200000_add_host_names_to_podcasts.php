<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('podcasts')) {
            Schema::table('podcasts', function (Blueprint $table) {
                if (!Schema::hasColumn('podcasts', 'host_a_name')) {
                    $table->string('host_a_name')->default('أليكس')->after('topic');
                }
                if (!Schema::hasColumn('podcasts', 'host_b_name')) {
                    $table->string('host_b_name')->default('سارة')->after('host_a_name');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('podcasts')) {
            Schema::table('podcasts', function (Blueprint $table) {
                if (Schema::hasColumn('podcasts', 'host_a_name')) {
                    $table->dropColumn('host_a_name');
                }
                if (Schema::hasColumn('podcasts', 'host_b_name')) {
                    $table->dropColumn('host_b_name');
                }
            });
        }
    }
};
