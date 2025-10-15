<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EProductsResource\Pages;
use App\Filament\Resources\EProductsResource\RelationManagers;
use App\Models\Product;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use phpDocumentor\Reflection\Types\Parent_;
use TomatoPHP\FilamentEcommerce\Filament\Resources\ProductResource as BaseProductResource;
use TomatoPHP\FilamentEcommerce\Filament\Resources\ProductResource\Pages\ListProducts;
use TomatoPHP\FilamentEcommerce\Filament\Resources\ProductResource\Pages\CreateProduct;
use TomatoPHP\FilamentEcommerce\Filament\Resources\ProductResource\Pages\EditProduct;

class EProductsResource extends BaseProductResource
{
    use Translatable;

    protected static ?string $model = Product::class;

    public static function form(Form $form): Form
    {
        // Get the existing components from the base ProductResource
        $components = parent::form($form)->getComponents();

        // Access the first child components
        $firstTab = $components[0];

        if (method_exists($firstTab, 'getChildComponents')) {
            $childComponents = $firstTab->getChildComponents();
            $seoTab = $childComponents[3]; // Assuming this is the 'SEO' tab

            $featureImage = $seoTab->getChildComponents()[0]; // First component in SEO tab
            $gallery = $seoTab->getChildComponents()[1]; // Second component in SEO tab

            // Modify the label of the 'Feature Image' component
            $featureImage->label('Feature Image : ratio (1:1)');

            // Modify the label of the 'Gallery' component
            $gallery->label('Gallery: ratio (4:3)');

            // You can also apply the changes to $components array to return the modified schema
            $seoTab->getChildComponents()[0] = $featureImage;
            $seoTab->getChildComponents()[1] = $gallery;
        }

        // Add the 'Select' component to the end of the components array
        $components[] = Forms\Components\Select::make('patient_type')
            ->label('Dosha Type') // Label for the dropdown
            ->multiple()
            ->options([
                'vata'  => 'Vata',
                'pitta' => 'Pitta',
                'kafha' => 'Kafha',
            ]);

        return $form->schema($components);
    }

    public static function table(Table $table): Table
    {
        $schema = parent::table($table)->getColumns();

        $filteredSchema = array_filter($schema, function ($column) {
            return $column->getName() !== 'type';
        });
        return $table
            ->columns($filteredSchema);
    }


    public static function getPages(): array
    {
        return [
            // 'index' => ListProducts::route('/'),
            // 'create' => CreateProduct::route('/create'),
            //'edit' =>  EProductsResource\Pages\EditEProducts::route('/{record}/edit'),
            //'edit' =>  EditProduct::route('/{record}/edit'),

            'index' => Pages\ListEProducts::route('/'),
            'create' => Pages\CreateEProducts::route('/create'),
            'edit' =>  EProductsResource\Pages\EditEProducts::route('/{record}/edit'),
        ];
    }
}
