<?php

namespace App\Filament\Resources\TutorApplicationResource\Pages;

use App\Filament\Resources\TutorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTutorApplication extends ViewRecord
{
    protected static string $resource = TutorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}