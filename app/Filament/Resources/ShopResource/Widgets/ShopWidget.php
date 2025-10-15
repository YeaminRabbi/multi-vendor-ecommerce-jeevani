<?php

namespace App\Filament\Resources\ShopResource\Widgets;

use Illuminate\Database\Eloquent\Model;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Support\Facades\Request;

class ShopWidget extends BaseWidget
{
    public $productCount = 0;

    protected static ?string $pollingInterval = null;

    public function mount($productCount): void
    {
        $this->productCount = $productCount;
    }

    protected function getStats(): array
    {   

        $productCount =  $this->productCount;

        return [
            Stat::make('Products', $this->productCount)
            ->description('Total Products in Shop')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
        
    }
}