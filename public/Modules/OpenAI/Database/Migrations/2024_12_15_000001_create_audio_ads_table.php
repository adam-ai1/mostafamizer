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
        if (Schema::hasTable('audio_ads')) {
            return;
        }
        
        Schema::create('audio_ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title')->nullable();
            $table->text('ad_text'); // النص الأساسي للإعلان
            $table->string('product_type')->nullable(); // نوع المنتج (تقنية، طعام، خدمات...)
            $table->string('ad_style')->default('professional'); // professional, casual, energetic, emotional
            $table->string('target_platform')->default('radio'); // radio, youtube, social_media, podcast
            $table->integer('target_duration')->default(30); // المدة المستهدفة بالثواني (15, 30, 60)
            $table->string('voice_id')->nullable(); // معرف الصوت من ElevenLabs
            $table->string('voice_name')->nullable(); // اسم الصوت
            $table->string('background_music')->nullable(); // نوع الموسيقى الخلفية
            $table->float('music_volume')->default(0.2); // مستوى صوت الموسيقى (0-1)
            $table->longText('generated_script')->nullable(); // السكريبت المُولّد
            $table->string('audio_path')->nullable(); // مسار ملف الصوت النهائي
            $table->string('audio_voice_only')->nullable(); // مسار الصوت بدون موسيقى
            $table->integer('actual_duration')->nullable(); // المدة الفعلية بالثواني
            $table->string('status')->default('pending'); // pending, processing, completed, failed
            $table->string('tier')->default('free'); // free, premium
            $table->text('error_message')->nullable();
            $table->string('provider')->default('elevenlabs');
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
        Schema::dropIfExists('audio_ads');
    }
};
