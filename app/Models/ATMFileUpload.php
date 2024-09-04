<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATMFileUpload extends Model
{
    use HasFactory;
    protected $table = 'a_t_m_file_uploads';

    protected $fillable = [
        'terminal_id',
        'terminal_name',
        'bank_name',
        'total_amount',
        'processing_date',
        'total_amount_1',
        'trx_no',
        'tot_fee',
        'bank_fee',
    ];
}
