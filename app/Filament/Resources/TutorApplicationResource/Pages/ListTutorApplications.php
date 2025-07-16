<?php

namespace App\Filament\Resources\TutorApplicationResource\Pages;

use App\Filament\Resources\TutorApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTutorApplications extends ListRecords
{
    protected static string $resource = TutorApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}