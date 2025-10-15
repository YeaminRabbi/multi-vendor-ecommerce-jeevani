<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
     use HasTranslations;

    protected $table = 'categories';

    public $translatable = ['name', 'description'];

    protected $fillable = ['parent_id', 'for', 'type', 'name', 'slug', 'description', 'icon', 'color', 'is_active', 'show_in_menu', 'created_at', 'updated_at', 'deleted_at'];



    public function children()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function meta()
    {
        return $this->hasMany('App\Models\CategoriesMeta');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_has_categories', 'category_id', 'product_id');
    }

    public function categoryProducts()
    {
        return $this->hasMany(Product::class,  'category_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeMenu($query)
    {
        return $query->where('show_in_menu', 1);
    }

    protected function getJsonAttribute($attribute, $default = 'Default Category Name')
    {
        $value = json_decode($this->attributes[$attribute], true);
        return $value['en'] ?? $default;
    }

    public function getNameAttribute()
    {
        return $this->getJsonAttribute('name');
    }

    public function getDescriptionAttribute()
    {
        return $this->getJsonAttribute('description');
    }
}
