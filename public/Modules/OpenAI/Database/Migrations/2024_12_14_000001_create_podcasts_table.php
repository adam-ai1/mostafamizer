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
            return;
        }
        
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->string('topic');
            $table->text('source_material')->nullable();
            $table->longText('script')->nullable();
            $table->string('status')->default('pending'); // pending, processing, completed, failed
            $table->string('tier')->default('free'); // free, premium
            $table->integer('estimated_duration')->nullable(); // in seconds
            $table->integer('word_count')->nullable();
            $table->text('error_message')->nullable();
            $table->string('provider')->default('gemini');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
