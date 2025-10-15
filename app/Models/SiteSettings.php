<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    use HasFactory;

    protected $table = 'settings';
    
    protected $fillable = [
        'group',
        'name',
        'locked',
        'payload',
    ];
    
    protected $casts = [
        'payload' => 'json',  // Cast the payload field as JSON
    ];
}
