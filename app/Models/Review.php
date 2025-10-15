<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';

    protected $fillable = [
        'account_id',
        'product_id',
        'review',
        'rate',
        'is_activated',
    ];

    public function account(){
        return $this->belongsTo(User::class, 'account_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
