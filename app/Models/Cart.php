<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    
    protected $table = 'carts';

    protected $fillable = [
        'account_id',
        'user_id',
        'product_id',
        'session_id',
        'item',
        'price',
        'discount',
        'vat',
        'qty',
        'total',
        'note',
        'options',
        'is_active',
    ];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
