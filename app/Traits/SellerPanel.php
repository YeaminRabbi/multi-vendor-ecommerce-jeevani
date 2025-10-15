<?php

namespace App\Traits;

use App\Models\Shop;
use Filament\Notifications\Notification;

trait SellerPanel
{
    protected static function currentShopId(){
        return auth()->user()->sellerShop->id ?? false;
    }

    protected static function currentShopDetails(){
        return Shop::find(auth()->user()->sellerShop->id ?? false);
    }

    //prevent seler panel from non seller /
    protected static function preventSellerPanel(){
        if(!auth()->user()->hasRole('seller')) {
            Notification::make()
                ->title('Access Denied')
                ->body('You are not seller.')
                ->danger()
                ->send();
//            return redirect(to: '/login');
            return false;
        }
    }
}
