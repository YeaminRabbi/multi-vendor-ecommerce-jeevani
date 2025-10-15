<?php

namespace App\Filament\Resources\ShopResource\Pages;

use App\Filament\Resources\ShopResource;
use Filament\Resources\Pages\Page;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;
use Illuminate\Database\Eloquent\Model;

class ShopOverview extends Page
{
    use HasPageSidebar;

    protected static string $resource = ShopResource::class;

    protected static string $view = 'filament.resources.shop-resource.pages.shop-overview';

    public $record;
    public $productCount;

    public function mount($record)
    {
        $this->record = \App\Models\Shop::findorfail($record);
        $this->productCount = $this->record->product()->count();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ShopResource\Widgets\ShopWidget::make([
                'productCount' => $this->productCount
            ]),
        ];
    }
        
}
