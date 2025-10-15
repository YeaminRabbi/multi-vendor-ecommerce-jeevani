<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'uuid',
        'type',
        'user_id',
        'country_id',
        'area_id',
        'city_id',
        'address_id',
        'account_id',
        'cashier_id',
        'coupon_id',
        'shipper_id',
        'shipping_vendor_id',
        'company_id',
        'branch_id',
        'name',
        'phone',
        'flat',
        'address',
        'source',
        'shipper_vendor',
        'total',
        'discount',
        'shipping',
        'vat',
        'status',
        'is_approved',
        'is_closed',
        'is_on_table',
        'table',
        'notes',
        'has_returns',
        'return_total',
        'reason',
        'is_payed',
        'payment_method',
        'payment_vendor',
        'payment_vendor_id',
        'created_at',
        'updated_at',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeAuthoried($query){
        return $query->where('user_id', auth()->id());
    }
    
}
