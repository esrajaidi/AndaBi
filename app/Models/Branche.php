<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'branche_number', 'branche_name','active',
    ];

    
    public function users()
    {
        return $this->hasOne(User::class);
    }
    
}
