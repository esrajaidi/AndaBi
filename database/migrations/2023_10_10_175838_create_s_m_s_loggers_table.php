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
        Schema::create('s_m_s_loggers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_number');
            $table->text('message_text');
            $table->dateTime('message_time');
            $table->boolean('message_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_m_s_loggers');
    }
};
