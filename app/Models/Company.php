<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'country_id',
        'name',
        'ceo',
        'address',
        'city',
        'zip',
        'registration_number',
        'tax_number',
        'email',
        'phone',
        'website',
        'notes',
    ];
}
