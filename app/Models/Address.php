<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'address_line_1', 
        'address_line_2', 
        'city', 
        'country', 
        'state', 
        'zip_code', 
        'business_name', 
        'is_default',
        'mark'
    ];

    // Optionally, add relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
