<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use \TomatoPHP\FilamentEcommerce\Models\Product as BaseProduct;

class Product extends BaseProduct
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTranslations;
    use HasFactory;

    public $translatable = ['name', 'about', 'description', 'details', 'keywords'];

    protected $fillable = [
        'category_id', 'keywords','name', 'slug', 'sku', 'barcode', 'type', 'about', 'description', 'details', 'price', 'discount',
        'discount_to', 'vat', 'is_in_stock', 'is_activated', 'is_shipped', 'is_trend', 'has_options', 'has_multi_price', 'has_unlimited_stock', 'has_max_cart',
        'min_cart', 'max_cart', 'has_stock_alert', 'min_stock_alert', 'max_stock_alert', 'created_at', 'updated_at', 'shop_id', 'patient_type'];

    protected $table = 'products';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        // Merge the parent's casts with your custom ones
//        $this->casts = array_merge($this->casts, [
//            'patient_type' => 'array', // Add your custom cast fields
//        ]);
    }
    protected $casts = [
        'patient_type' => 'array',  // Cast to array to handle multiple selections
    ];
    public function scopeActive($query)
    {
        return $query->where('is_activated', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_has_categories', 'product_id', 'category_id');
    }

    public function gallery()
    {
        return $this->hasMany(Media::class, 'model_id')->where('model_type', Product::class);
    }

    public function featured()
    {
        return $this->hasOne(Media::class, 'model_id')->where('model_type', Product::class)->where('collection_name', 'feature_image');
    }

    public function getFeaturedImageUrlAttribute()
    {
        $featured = $this->featured()->first();
        return $featured ? Storage::url($featured->id.'/'.$featured->file_name) : null;
    }

    public function getMediaUrlsAttribute()
    {
        return $this->gallery->map(function ($gallery) {
            return Storage::url($gallery->id.'/'.$gallery->file_name);
        });
    }

    // validates the discount_to date and returns the actual price of product
    public function getDiscountPriceAttribute()
    {
        $price = $this->attributes['price'];
        $discount = $this->attributes['discount'];
        $discountTo = $this->attributes['discount_to'];

        if ($discount && $discountTo) {
            $currentDate = Carbon::today();
            $discountEndDate = Carbon::parse($discountTo);

            if ($currentDate->lte($discountEndDate)) {
                // Calculate the discounted price
                $discountedPrice = $price - ($price * ($discount / 100));
                return $discountedPrice;
            }
        }

        // If no discount or the discount date is not valid, return the original price
        return $price;
    }

    public function checkDiscountValidity()
    {
        $discountTo = $this->attributes['discount_to'];

        if ($discountTo) {
            $currentDate = Carbon::today();
            $discountEndDate = Carbon::parse($discountTo);

            if ($currentDate->lte($discountEndDate)) {
               return 1;
            }
        }

        return 0;
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id')->where('is_activated', 1);
    }

    public function avgRating()
    {
        return $this->reviews()->avg('rate') ?: 0;
    }

    public function store(){
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}



