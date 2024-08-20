<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSLogger extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'message_text',
        'message_time',
        'message_status'


    ];
}
