<?php
namespace App\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Database\Eloquent\Model;

class SellerDashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'seller.pages.dashboard';
    //protected static string $view = 'filament.pages.dashboard';
    protected static string $routePath = 'dashboard';

}



