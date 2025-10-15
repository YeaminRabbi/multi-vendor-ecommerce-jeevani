<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    public function getUrlAttribute()
    {
        return Storage::url($this->file_name); 
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'model_id')->where('model_type', 'TomatoPHP\\FilamentEcommerce\\Models\\Product');
    }

}
