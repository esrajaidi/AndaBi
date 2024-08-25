<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOBDXCom extends Model
{
    use HasFactory;

    // Define the table name if it's different from the plural of the model name
    protected $table = 'transaction_o_b_d_x_coms';

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
        'entry_sr_no',
    ];
    
}
