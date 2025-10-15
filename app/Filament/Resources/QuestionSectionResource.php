<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionSectionResource\Pages;
use App\Filament\Resources\QuestionSectionResource\RelationManagers;
use App\Models\QuestionSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
class QuestionSectionResource extends Resource
{
    protected static ?string $model = QuestionSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Section Name')
                    ->required(),
                Textarea::make('description')
                    ->label('Section Description')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Section Name'),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListQuestionSections::route('/'),
            'create' => Pages\CreateQuestionSection::route('/create'),
            'edit' => Pages\EditQuestionSection::route('/{record}/edit'),
        ];
    }
}
