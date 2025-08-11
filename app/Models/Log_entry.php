<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log_entry extends Model
{
    use SoftDeletes;

    protected $table = 'log_entry';

    protected $fillable = [
        'reason_entry',
        'user_id',
        'production_id',
        'date_entry',
        'quantity'
    ];
}
