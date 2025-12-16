<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();

            $table->BigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('unique_identifier')->unique();

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('country_code', 10)->nullable();
            $table->string('channel')->nullable()->comment('email, sms, whatsapp, telegram, social media etc.');

            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamp('last_contacted_at')->nullable()->default(NULL);
            $table->timestamps();

            $table->unique(['user_id', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
