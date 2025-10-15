<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use TomatoPHP\FilamentEcommerce\Models\Product;

class SellerProduct extends Product implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;
    use HasFactory;

    public $translatable = ['name', 'about', 'description', 'details', 'keywords'];
    protected $table = 'seller_products';

}
