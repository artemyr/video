<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Support\ValueObjects\Size;

class PortfolioResource extends Resource
{
    public const VIDEO_MAX_FILE_SIZE = 512000;

    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Checkbox::make('active')
                    ->default(true),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\TextInput::make('size')
                    ->afterStateHydrated(function ($component, $state) {
                        if ($state instanceof Size) {
                            $component->state($state->row());
                        }
                    })
                    ->dehydrateStateUsing(function ($state, $component) {
                        return new Size($state);
                    }),
                Forms\Components\TextInput::make('sort')
                    ->integer()
                    ->default(500),
                Forms\Components\FileUpload::make('image')
                    ->disk('images')
                    ->directory('portfolio')
                    ->required(),
                Forms\Components\FileUpload::make('video')
                    ->disk('video')
                    ->directory('portfolio')
                    ->maxSize(self::VIDEO_MAX_FILE_SIZE)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('sort')
                    ->sortable(),
                Tables\Columns\CheckboxColumn::make('active')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->disk('images'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
            ])
            ->filters([
                Filter::make('is_active')
                    ->query(fn (Builder $query): Builder => $query->where('active', true))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }

//    public static function mutateFormDataBeforeSave(array $data): array
//    {
//        return $data;
//    }
}
