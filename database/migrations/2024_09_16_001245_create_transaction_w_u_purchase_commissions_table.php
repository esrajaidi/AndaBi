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
        Schema::create('transaction_w_u_purchase_commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trn_ref_no'); // Transaction Reference Number
            $table->string('event'); // Event
            $table->string('brn'); // Branch
            $table->string('ac_no'); // Account Number
            $table->string('ccy'); // Currency
            $table->enum('drcr', ['D', 'C']); // Debit or Credit
            $table->string('trn_code'); // Transaction Code
            $table->decimal('fcy_amount', 15, 3)->nullable(); // Foreign Currency Amount
            $table->decimal('exch_rate', 10, 6)->nullable(); // Exchange Rate
            $table->decimal('lcy_amount', 15, 3); // Local Currency Amount
            $table->date('trn_date'); // Transaction Date
            $table->date('value_date'); // Value Date
            $table->string('related_account')->nullable(); // Related Account
            $table->string('maker')->nullable(); // Maker
            $table->string('checker')->nullable(); // Checker
            $table->string('entry_sr_no')->nullable(); // Entry Serial Number
            $table->timestamps(); // Created at and Updated at times
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_w_u_purchase_commissions');
    }
};
