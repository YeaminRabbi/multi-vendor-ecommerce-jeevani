<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use TomatoPHP\FilamentEcommerce\Filament\Resources\ProductResource;

class EditCategory extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = CategoryResource::class;

    public ?string $activeLocale = null;

    public static function getTranslatableLocales(): array
    {
        return ['en', 'ar'];
    }

//    protected function mutateFormDataBeforeFill(array $data): array
//    {
//        $data['prices'] = $this->getRecord()->meta('prices')??[];
//        $data['options'] = $this->getRecord()->meta('options')??[];
//
//        return $data;
//    }

    protected function afterSave()
    {
        $record = $this->getRecord();
        $data = $this->form->getState();


        if(isset($data['prices'])){
            $record->meta('prices', $data['prices']);
        }
        if(isset($data['options'])){
            $record->meta('options', $data['options']);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make()
        ];
    }
}
