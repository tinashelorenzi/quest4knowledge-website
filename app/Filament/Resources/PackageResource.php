<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Package Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., 5 Hour Package')
                            ->columnSpan(2),
                        
                        Forms\Components\Textarea::make('description')
                            ->placeholder('e.g., Perfect for getting started')
                            ->rows(3)
                            ->columnSpan(2),
                        
                        Forms\Components\TextInput::make('hours')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->suffix('hours')
                            ->placeholder('5'),
                        
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->placeholder('0'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pricing')
                    ->schema([
                        Forms\Components\TextInput::make('price_in_person')
                            ->required()
                            ->numeric()
                            ->prefix('R')
                            ->placeholder('300')
                            ->helperText('Total price for in-person tutoring'),
                        
                        Forms\Components\TextInput::make('price_online')
                            ->required()
                            ->numeric()
                            ->prefix('R')
                            ->placeholder('250')
                            ->helperText('Total price for online tutoring'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Features')
                    ->schema([
                        Forms\Components\Repeater::make('features')
                            ->schema([
                                Forms\Components\TextInput::make('feature')
                                    ->required()
                                    ->placeholder('e.g., 1-on-1 sessions')
                                    ->hiddenLabel(),
                            ])
                            ->addActionLabel('Add Feature')
                            ->defaultItems(0)
                            ->columns(1),
                    ]),

                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Featured Package')
                            ->helperText('Featured packages are highlighted on the website'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Only active packages are shown on the website'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold),
                
                Tables\Columns\TextColumn::make('hours')
                    ->suffix(' hrs')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('price_in_person')
                    ->label('In-Person')
                    ->money('ZAR')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('price_online')
                    ->label('Online')
                    ->money('ZAR')
                    ->sortable()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('hourly_rate_in_person')
                    ->label('Per Hour (In-Person)')
                    ->money('ZAR')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('hourly_rate_online')
                    ->label('Per Hour (Online)')
                    ->money('ZAR')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->alignCenter(),
                
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All packages')
                    ->trueLabel('Active packages')
                    ->falseLabel('Inactive packages'),
                
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->placeholder('All packages')
                    ->trueLabel('Featured packages')
                    ->falseLabel('Non-featured packages'),
                
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->emptyStateHeading('No packages found')
            ->emptyStateDescription('Create your first tutoring package to get started.')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}