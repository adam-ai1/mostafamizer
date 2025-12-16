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
        if (Schema::hasTable('podcasts')) {
            Schema::table('podcasts', function (Blueprint $table) {
                // Check and add columns if they don't exist
                if (!Schema::hasColumn('podcasts', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'title')) {
                    $table->string('title')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'topic')) {
                    $table->string('topic')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'source_material')) {
                    $table->text('source_material')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'script')) {
                    $table->longText('script')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'status')) {
                    $table->string('status')->default('pending');
                }
                if (!Schema::hasColumn('podcasts', 'tier')) {
                    $table->string('tier')->default('free');
                }
                if (!Schema::hasColumn('podcasts', 'estimated_duration')) {
                    $table->integer('estimated_duration')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'word_count')) {
                    $table->integer('word_count')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'error_message')) {
                    $table->text('error_message')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'provider')) {
                    $table->string('provider')->default('gemini');
                }
                if (!Schema::hasColumn('podcasts', 'metadata')) {
                    $table->json('metadata')->nullable();
                }
                if (!Schema::hasColumn('podcasts', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
