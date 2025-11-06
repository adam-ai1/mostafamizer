<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_jobs', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('unique_identifier')->unique();
            
            $table->string('provider')->nullable();
            $table->string('provider_task_id')->nullable();
            $table->enum('status', ['queued','running','succeeded','failed','canceled'])->default('queued')->index();
            $table->text('result_url')->nullable();
            $table->unsignedTinyInteger('progress')->default(0);
            $table->text('error')->nullable();
            
            $table->longText('raw_response')->nullable()->default(NULL);
            
            $table->timestamp('next_check_at')->nullable();
            $table->timestamp('started_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_jobs');
    }
}
