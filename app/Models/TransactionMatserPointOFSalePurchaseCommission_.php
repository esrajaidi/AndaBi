<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMatserPointOFSalePurchaseCommission_ extends Model
{
    use HasFactory;
    protected $table = 'transaction_matser_point_o_f_sale_purchase_commissions_';

    // Define the fillable attributes
    protected $fillable = [
        'trn_ref_no',
        'event',
        'brn',
        'ac_no',
        'ccy',
        'drcr',
        'trn_code',
        'fcy_amount',
        'exch_rate',
        'lcy_amount',
        'trn_date',
        'value_date',
        'related_account',
        'maker',
        'checker',
    ];
}
