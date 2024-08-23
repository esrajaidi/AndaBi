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
        Schema::create('transaction_p_o_s', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchant_no')->unique();
            $table->string('merchant_name');
            $table->string('banking_account_no');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_number');
            $table->decimal('net_amount', 15, 2);
            $table->date('processing_date');
            $table->decimal('total_amount', 15, 2);
            $table->string('trx_no');
            $table->string('file_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_p_o_s');
    }
};
