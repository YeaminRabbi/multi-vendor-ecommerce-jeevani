<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orders_items';

    protected $fillable = [
        'order_id',
        'refund_id',
        'warehouse_move_id',
        'account_id',
        'product_id',
        'item',
        'price',
        'discount',
        'vat',
        'total',
        'returned',
        'qty',
        'returned_qty',
        'is_free',
        'is_returned',
        'options',
        'created_at',
        'updated_at',
        'shop_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
