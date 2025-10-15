<?php

namespace App\Filament\Resources\QuestionSectionResource\Pages;

use App\Filament\Resources\QuestionSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionSection extends EditRecord
{
    protected static string $resource = QuestionSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
