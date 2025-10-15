<?php

namespace Junk;

use App\Filament\Resources\WidgetResource\Pages;
use App\Filament\Resources\WidgetResource\RelationManagers;
use App\Models\Widget;
use App\Models\WidgetGroup;
use Filament\Forms\Components\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WidgetResource extends Resource
{
    protected static ?string $model = Widget::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Widgets';
    protected static ?string $pluralLabel = 'Widgets';
//    protected static ?string $cluster = ClustersWidget::class;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('group_id')
                ->label('Widget Group')
                ->options(WidgetGroup::all()->pluck('group_name', 'id'))
                ->required(),
            TextInput::make('meta_title')
                ->label('Meta Title')
                ->required(),
            TextInput::make('meta_name')
                ->label('Meta Name')
                ->required(),
            Select::make('field_type')
                ->label('Field Type')
                ->options([
                    'text field' => 'Text Field',
                    'image field' => 'Image Field',
                    'textarea' => 'Textarea',
                    'markdown' => 'Markdown',
                    'richeditor' => 'Rich Editor',
                ])
                ->required(),
            TextInput::make('sorting')
                ->label('Sorting')
                ->numeric()
                ->nullable(),
            TextInput::make('placeholder')
                ->label('Placeholder')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {

        return $table
        ->columns([
            TextColumn::make('group.group_name')
                ->label('Group Name')
                ->sortable(),
            TextColumn::make('meta_title')
                ->label('Meta Title')
                ->sortable()
                ->searchable(),
            TextColumn::make('field_type')
                ->label('Field Type')
                ->sortable(),
            TextColumn::make('sorting')
                ->label('Sorting')
                ->sortable(),
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Junk\WidgetResource\Pages\ListWidgets::route('/'),
            'create' => \Junk\WidgetResource\Pages\CreateWidget::route('/create'),
            'edit' => \Junk\WidgetResource\Pages\EditWidget::route('/{record}/edit'),
        ];
    }
}
