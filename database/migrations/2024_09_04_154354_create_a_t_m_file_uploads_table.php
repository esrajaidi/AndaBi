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
        Schema::create('a_t_m_file_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('terminal_id');
            $table->string('terminal_name');
            $table->string('bank_name');
            $table->decimal('total_amount', 15, 3);
            $table->date('processing_date');
            $table->decimal('total_amount_1', 15, 3)->nullable();
            $table->string('trx_no');
            $table->decimal('tot_fee', 15, 3)->nullable();
            $table->decimal('bank_fee', 15, 3)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_t_m_file_uploads');
    }
};
