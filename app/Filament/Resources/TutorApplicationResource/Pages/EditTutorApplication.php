<?php

namespace App\Filament\Resources\TutorApplicationResource\Pages;

use App\Filament\Resources\TutorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTutorApplication extends EditRecord
{
    protected static string $resource = TutorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}