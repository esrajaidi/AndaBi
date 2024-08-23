<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPOS extends Model
{
    use HasFactory;

    protected $table = 'transaction_p_o_s';

    // The attributes that are mass assignable.
    protected $fillable = [
        'merchant_no',
        'merchant_name',
        'banking_account_no',
        'bank_name',
        'branch_number',
        'branch_name',
        'net_amount',
        'processing_date',
        'total_amount',
        'trx_no',
        'file_name',
    ];

    public $timestamps = true;
}
