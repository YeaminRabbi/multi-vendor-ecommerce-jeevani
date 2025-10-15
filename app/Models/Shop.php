<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TomatoPHP\FilamentEcommerce\Models\Product;
use Illuminate\Support\Facades\Storage;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'cover_image',
        'user_id'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->hasMany(Product::class, 'shop_id');
    }

    public function getLogoAttribute()
    {
        $imageAttribute = $this->attributes['logo'];
        return $imageAttribute; //Storage::url($imageAttribute);
    }

    public function getCoverImageAttribute()
    {
        $imageAttribute = $this->attributes['cover_image'];
        return $imageAttribute; //Storage::url($imageAttribute);
    }
}
