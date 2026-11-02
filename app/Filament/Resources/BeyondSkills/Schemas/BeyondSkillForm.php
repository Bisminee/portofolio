<?php

namespace App\Filament\Resources\BeyondSkills\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BeyondSkillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Non-coding skill')
                    ->description('Leave this table empty until you are ready to publish a real entry.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(120),
                        TextInput::make('category')
                            ->maxLength(120)
                            ->helperText('Optional, for example: Leadership, Languages, Craft.'),
                        Textarea::make('description')
                            ->rows(3)
                            ->maxLength(600)
                            ->columnSpanFull(),
                        Select::make('icon')
                            ->options([
                                'quill' => 'Quill',
                                'spark' => 'Spark',
                                'book' => 'Book',
                                'users' => 'People',
                                'mic' => 'Microphone',
                                'camera' => 'Camera',
                                'globe' => 'Globe',
                                'heart' => 'Heart',
                                'trophy' => 'Trophy',
                                'palette' => 'Palette',
                            ])
                            ->placeholder('Decorative icon (optional)'),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_visible')
                            ->label('Visible on the portfolio')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
