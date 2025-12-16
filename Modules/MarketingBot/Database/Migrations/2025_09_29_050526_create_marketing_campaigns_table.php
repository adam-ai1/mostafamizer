<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_campaigns', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('raw_response')->nullable()->default(NULL);
            $table->string('unique_identifier')->unique();
            $table->string('channel')->nullable()->comment('email, sms, whatsapp, telegram, social media etc.');
            $table->enum('status', ['draft','scheduled','running','paused','published','archived', 'failed'])->default('draft');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
            $table->index(['status', 'starts_at', 'ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marketing_campaigns');
    }
}
