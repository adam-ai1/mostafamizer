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
        Schema::table('podcasts', function (Blueprint $table) {
            if (!Schema::hasColumn('podcasts', 'audio_path')) {
                $table->string('audio_path')->nullable()->after('script');
            }
            if (!Schema::hasColumn('podcasts', 'audio_host_a')) {
                $table->string('audio_host_a')->nullable()->after('audio_path');
            }
            if (!Schema::hasColumn('podcasts', 'audio_host_b')) {
                $table->string('audio_host_b')->nullable()->after('audio_host_a');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn(['audio_path', 'audio_host_a', 'audio_host_b']);
        });
    }
};
