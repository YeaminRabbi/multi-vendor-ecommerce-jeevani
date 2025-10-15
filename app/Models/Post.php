<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use TomatoPHP\FilamentCms\Models\Category;
use TomatoPHP\FilamentCms\Models\Post as BasePost;

class Post extends BasePost implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'title',
        'short_description',
        'keywords',
        'body'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_has_category', 'post_id', 'category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'posts_has_tags', 'post_id', 'tag_id');
    }

    public function postMeta()
    {
        return $this->hasMany('TomatoPHP\FilamentCms\Models\PostMeta');
    }

    public function meta(string $key, mixed $value=null): mixed
    {
        if($value){
            return $this->postMeta()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        else {
            return $this->postMeta()->where('key', $key)->first()?->value;
        }
    }

    public function featuredImage(){
       return $this->hasOne(Media::class, 'model_id', 'id')->where('model_type', 'TomatoPHP\FilamentCms\Models\Post');
    }
}
