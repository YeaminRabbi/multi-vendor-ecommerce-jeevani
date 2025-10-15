<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question_text')->label('Question')->required()->columnSpan('full'),
                Select::make('question_section_id')
                    ->label('Section')
                    ->relationship('section', 'name')
                    ->required(),
                Repeater::make('answers')->columns('3')->columnSpan('full')
                    ->relationship('answers')
                    ->schema([
                        TextInput::make('answer_text')->label('Answer')->required(),
                        Select::make('patient_type')
                            ->options([
                                'Vata' => 'Vata',
                                'Pitta' => 'Pitta',
                                'Kafha' => 'Kafha',
                            ])->required(),
                        Forms\Components\TagsInput::make('attributes')
                            ->label('Answer Attributes')
                            ->placeholder('E.g. Multiple Value will be separated by comma'),
                    ])->minItems(1)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_text'),
                TextColumn::make('section.name')->label('Section'),
                TextColumn::make('answers.answer_text'),
                TextColumn::make('answers.patient_type')->label('Patient Type'),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
