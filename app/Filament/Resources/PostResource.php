<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\FileUpload::make('thumbnail')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(2048)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(2048),
                    Forms\Components\Select::make('category_id')
                        ->relationship('categories', 'title')
                        ->multiple()
                        ->preload()
                        ->searchable()
                        ->native(false),
                    Forms\Components\RichEditor::make('body')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('meta_title'),
                    Forms\Components\TextInput::make('meta_description'),
                    Forms\Components\Toggle::make('active')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->native(false),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(['title', 'body'])
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('user.name')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->button(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
