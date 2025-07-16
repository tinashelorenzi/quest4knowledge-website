<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewContact extends ViewRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\Action::make('markAsRead')
                ->icon('heroicon-o-eye')
                ->color('warning')
                ->action(function (Contact $record): void {
                    $record->update([
                        'status' => 'read',
                        'read_at' => now(),
                    ]);
                    $this->refreshFormData(['status', 'read_at']);
                })
                ->visible(fn (): bool => $this->record->status === 'new'),
            
            Actions\Action::make('markAsReplied')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function (Contact $record): void {
                    $record->update([
                        'status' => 'replied',
                        'replied_at' => now(),
                    ]);
                    $this->refreshFormData(['status', 'replied_at']);
                })
                ->visible(fn (): bool => $this->record->status !== 'replied'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Contact Details')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Full Name'),
                        Infolists\Components\TextEntry::make('email')
                            ->label('Email Address')
                            ->copyable()
                            ->copyMessage('Email copied to clipboard'),
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Phone Number')
                            ->copyable()
                            ->copyMessage('Phone number copied to clipboard'),
                        Infolists\Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'new' => 'success',
                                'read' => 'warning',
                                'replied' => 'primary',
                                default => 'secondary',
                            }),
                    ])->columns(2),
                
                Infolists\Components\Section::make('Message')
                    ->schema([
                        Infolists\Components\TextEntry::make('message')
                            ->prose()
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
                
                Infolists\Components\Section::make('Timestamps')
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Submitted')
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('read_at')
                            ->label('Read At')
                            ->dateTime()
                            ->placeholder('Not read yet'),
                        Infolists\Components\TextEntry::make('replied_at')
                            ->label('Replied At')
                            ->dateTime()
                            ->placeholder('Not replied yet'),
                    ])->columns(3),
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Auto-mark as read when viewing for the first time
        if ($this->record->status === 'new') {
            $this->record->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }

        return $data;
    }
}