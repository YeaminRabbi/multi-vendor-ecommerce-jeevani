<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    use HasFactory;

    protected $table = 'order_logs';

    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'note',
        'is_closed',
        'created_at',
        'updated_at',
    ];

}
