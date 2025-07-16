<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Leads';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Requirements')
                    ->schema([
                        Forms\Components\Select::make('level')
                            ->options([
                                'primary_school' => 'Primary School',
                                'high_school' => 'High School',
                                'university' => 'University',
                                'adult_learning' => 'Adult Learning',
                            ])
                            ->required(),
                        Forms\Components\Select::make('preference')
                            ->options([
                                'online' => 'Online',
                                'in_person' => 'In Person',
                                'both' => 'Both',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('message')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'converted' => 'Converted',
                                'closed' => 'Closed',
                            ])
                            ->default('new')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\BadgeColumn::make('level')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->colors([
                        'primary' => 'primary_school',
                        'success' => 'high_school',
                        'warning' => 'university',
                        'danger' => 'adult_learning',
                    ]),
                Tables\Columns\BadgeColumn::make('preference')
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->colors([
                        'primary' => 'online',
                        'success' => 'in_person',
                        'warning' => 'both',
                    ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'new',
                        'warning' => 'contacted',
                        'success' => 'converted',
                        'danger' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'converted' => 'Converted',
                        'closed' => 'Closed',
                    ]),
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'primary_school' => 'Primary School',
                        'high_school' => 'High School',
                        'university' => 'University',
                        'adult_learning' => 'Adult Learning',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Contact Information')
                    ->schema([
                        Components\TextEntry::make('first_name'),
                        Components\TextEntry::make('last_name'),
                        Components\TextEntry::make('email')
                            ->copyable(),
                        Components\TextEntry::make('phone')
                            ->copyable(),
                    ])->columns(2),

                Components\Section::make('Requirements')
                    ->schema([
                        Components\TextEntry::make('level')
                            ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                        Components\TextEntry::make('preference')
                            ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state))),
                        Components\TextEntry::make('message')
                            ->columnSpanFull(),
                    ])->columns(2),

                Components\Section::make('Status & Tracking')
                    ->schema([
                        Components\TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'new' => 'secondary',
                                'contacted' => 'warning',
                                'converted' => 'success',
                                'closed' => 'danger',
                            }),
                        Components\TextEntry::make('created_at')
                            ->dateTime(),
                        Components\TextEntry::make('updated_at')
                            ->dateTime(),
                    ])->columns(3),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'view' => Pages\ViewLead::route('/{record}'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}