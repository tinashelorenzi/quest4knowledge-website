<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationGroup = 'Contact Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Contact Submissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20)
                            ->columnSpan(1),
                        
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'read' => 'Read',
                                'replied' => 'Replied',
                            ])
                            ->required()
                            ->default('new')
                            ->columnSpan(1),
                        
                        Forms\Components\Textarea::make('message')
                            ->required()
                            ->rows(5)
                            ->columnSpan(2),
                    ])->columns(2),
                
                Forms\Components\Section::make('Timestamps')
                    ->schema([
                        Forms\Components\DateTimePicker::make('read_at')
                            ->nullable()
                            ->columnSpan(1),
                        
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->nullable()
                            ->columnSpan(1),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email address copied'),
                
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Phone number copied'),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'new',
                        'warning' => 'read',
                        'primary' => 'replied',
                    ])
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('message')
                    ->limit(50)
                    ->tooltip(function (Contact $record): string {
                        return $record->message;
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->since()
                    ->label('Submitted'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'replied' => 'Replied',
                    ]),
                
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('markAsRead')
                    ->icon('heroicon-o-eye')
                    ->color('warning')
                    ->action(function (Contact $record): void {
                        $record->update([
                            'status' => 'read',
                            'read_at' => now(),
                        ]);
                    })
                    ->visible(fn (Contact $record): bool => $record->status === 'new'),
                
                Tables\Actions\Action::make('markAsReplied')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Contact $record): void {
                        $record->update([
                            'status' => 'replied',
                            'replied_at' => now(),
                        ]);
                    })
                    ->visible(fn (Contact $record): bool => $record->status !== 'replied'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('markAsRead')
                        ->icon('heroicon-o-eye')
                        ->color('warning')
                        ->action(function ($records): void {
                            $records->each(function ($record) {
                                $record->update([
                                    'status' => 'read',
                                    'read_at' => now(),
                                ]);
                            });
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto-refresh every 30 seconds for new submissions
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('status', 'new')->count() > 0 ? 'warning' : null;
    }
}