<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;
use Filament\Models\Contracts\FilamentUser;
use App\Traits\SellerPanel;
use Filament\Models\Contracts\HasAvatar;
class User extends Authenticatable implements FilamentUser, MustVerifyEmail, HasAvatar
{
    use HasFactory, Notifiable, HasRoles, CanResetPassword, SellerPanel, HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_photo_path',
        'email_verified_at',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getProfilePhotoUrlAttribute()
    {

    }
    public function getFilamentAvatarUrl(): ?string
    {
        return $this->profile_photo_path;
    }
    public function canAccessPanel(Panel $panel): bool
    {
        if (auth()->check() && auth()->user()->hasRole('super-admin') && $panel->getId() === 'admin') {
            return true;
        }
        if (auth()->check() && auth()->user()->hasRole('seller') && $panel->getId() === 'seller') {
            return true;
        }
        return false;
    }
    public function sellerProducts()
    {
        return $this->hasMany(Product::class);
    }
    public function sellerShops()
    {
        return $this->hasMany(Shop::class, 'user_id', 'id');
    }
    public function sellerShop()
    {
        return $this->hasOne(Shop::class, 'user_id', 'id');
    }



}
