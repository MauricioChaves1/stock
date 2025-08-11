<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log_out extends Model
{
    use SoftDeletes;

    protected $table = 'log_out';

    protected $fillable = [
        'reason_out',
        'user_id',
        'production_id',
        'date_out',
        'quantity'
    ];
}
