<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TutorApplicationResource\Pages;
use App\Models\TutorApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Illuminate\Support\Facades\Storage;

class TutorApplicationResource extends Resource
{
    protected static ?string $model = TutorApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Tutor Applications';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
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

                Forms\Components\Section::make('Status & Notes')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->rows(3),
                    ])->columns(1),
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('education_level')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
                Tables\Columns\TextColumn::make('teaching_experience_years')
                    ->label('Experience')
                    ->suffix(' years'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('education_level')
                    ->options([
                        'High School' => 'High School',
                        'Bachelors' => 'Bachelors',
                        'MSc(Masters)' => 'Masters',
                        'PhD(Doctorate)' => 'Doctorate',
                        'Other' => 'Other',
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
                Components\Section::make('Personal Information')
                    ->schema([
                        Components\TextEntry::make('full_name')->label('Full Name'),
                        Components\TextEntry::make('email'),
                        Components\TextEntry::make('phone'),
                        Components\TextEntry::make('street_address'),
                        Components\TextEntry::make('city'),
                        Components\TextEntry::make('state'),
                        Components\TextEntry::make('zip_code'),
                    ])->columns(2),

                Components\Section::make('Education & Subjects')
                    ->schema([
                        Components\TextEntry::make('education_level'),
                        Components\TextEntry::make('tutoring_subjects')
                            ->badge()
                            ->listWithLineBreaks(),
                        Components\TextEntry::make('other_subjects'),
                    ])->columns(1),

                Components\Section::make('Teaching Information')
                    ->schema([
                        Components\IconEntry::make('has_teaching_certification')
                            ->boolean()
                            ->label('Teaching Certification'),
                        Components\TextEntry::make('teaching_experience_years')
                            ->suffix(' years'),
                        Components\IconEntry::make('can_do_online_tutoring')
                            ->boolean()
                            ->label('Online Tutoring'),
                        Components\TextEntry::make('teaching_methods')
                            ->badge()
                            ->listWithLineBreaks(),
                        Components\TextEntry::make('available_days')
                            ->badge()
                            ->listWithLineBreaks(),
                        Components\TextEntry::make('available_times')
                            ->badge()
                            ->listWithLineBreaks(),
                        Components\IconEntry::make('flexible_scheduling')
                            ->boolean()
                            ->label('Flexible Scheduling'),
                    ])->columns(2),

                Components\Section::make('Documents')
                    ->schema([
                        Components\TextEntry::make('matric_transcript')
                            ->url(fn ($record) => $record->matric_transcript ? Storage::url($record->matric_transcript) : null)
                            ->openUrlInNewTab(),
                        Components\TextEntry::make('university_transcript')
                            ->url(fn ($record) => $record->university_transcript ? Storage::url($record->university_transcript) : null)
                            ->openUrlInNewTab(),
                        Components\TextEntry::make('id_document')
                            ->url(fn ($record) => $record->id_document ? Storage::url($record->id_document) : null)
                            ->openUrlInNewTab(),
                        Components\TextEntry::make('police_clearance')
                            ->url(fn ($record) => $record->police_clearance ? Storage::url($record->police_clearance) : null)
                            ->openUrlInNewTab(),
                    ])->columns(2),

                Components\Section::make('Application Status')
                    ->schema([
                        Components\TextEntry::make('status')->badge(),
                        Components\TextEntry::make('notes'),
                        Components\TextEntry::make('created_at')->dateTime(),
                        Components\TextEntry::make('updated_at')->dateTime(),
                    ])->columns(2),
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
            'index' => Pages\ListTutorApplications::route('/'),
            'create' => Pages\CreateTutorApplication::route('/create'),
            'view' => Pages\ViewTutorApplication::route('/{record}'),
            'edit' => Pages\EditTutorApplication::route('/{record}/edit'),
        ];
    }
}