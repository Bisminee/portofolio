<?php

namespace App\Filament\Resources\Activities\Schemas;

use App\Models\Activity;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Activity')
                    ->description('Identity, role, and publication status.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(160)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, $set) {
                                if ($operation === 'create') {
                                    $set('slug', str()->slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(160)
                            ->unique(ignoreRecord: true),
                        Select::make('type')
                            ->required()
                            ->options([
                                'organization' => 'Organization',
                                'competition' => 'Competition',
                                'community' => 'Community',
                                'volunteer' => 'Volunteer work',
                                'workshop' => 'Workshop',
                                'speaking' => 'Speaking',
                            ])
                            ->default('organization'),
                        TextInput::make('organization')
                            ->required()
                            ->maxLength(180),
                        TextInput::make('role_en')
                            ->label('Role (English)')
                            ->required()
                            ->maxLength(180),
                        TextInput::make('role_id')
                            ->label('Role (Indonesian)')
                            ->required()
                            ->maxLength(180),
                        DatePicker::make('start_date')
                            ->required()
                            ->native(false),
                        DatePicker::make('end_date')
                            ->native(false)
                            ->helperText('Leave empty if the activity is ongoing.'),
                        Toggle::make('is_ongoing')
                            ->label('Ongoing'),
                        Select::make('team_type')
                            ->required()
                            ->options([
                                'team' => 'Team',
                                'leadership' => 'Team / leadership',
                                'individual' => 'Individual',
                            ])
                            ->default('team'),
                        TextInput::make('priority')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_published')
                            ->label('Published on the portfolio')
                            ->default(false),
                        Select::make('permission_status')
                            ->required()
                            ->options([
                                'approved_by_owner' => 'Approved by owner',
                                'pending' => 'Permission pending',
                                'declined' => 'Do not publish',
                            ])
                            ->default('pending')
                            ->helperText('Only “approved by owner” records are rendered publicly.'),
                        Select::make('related_slug')
                            ->label('Related activity')
                            ->options(fn (): array => Activity::query()
                                ->orderBy('priority')
                                ->pluck('name', 'slug')
                                ->all())
                            ->searchable()
                            ->placeholder('None'),
                        TextInput::make('location')
                            ->helperText('Stored for reference only; not displayed publicly unless explicitly enabled.'),
                        TextInput::make('work_format')
                            ->label('Work format')
                            ->helperText('Stored for reference only; not displayed publicly.'),
                    ])
                    ->columns(2),

                Section::make('English content')
                    ->schema([
                        Textarea::make('description_en')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Repeater::make('highlights_en')
                            ->label('Highlights')
                            ->simple(TextInput::make('item')->required())
                            ->maxItems(3)
                            ->addActionLabel('Add highlight')
                            ->columnSpanFull(),
                    ]),

                Section::make('Indonesian content')
                    ->schema([
                        Textarea::make('description_id')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                        Repeater::make('highlights_id')
                            ->label('Highlights')
                            ->simple(TextInput::make('item')->required())
                            ->maxItems(3)
                            ->addActionLabel('Add highlight')
                            ->columnSpanFull(),
                    ]),

                Section::make('Media and evidence')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Main image')
                            ->disk('portfolio')
                            ->image()
                            ->maxSize(4096)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->dehydrateStateUsing(fn ($state) => is_array($state) ? (array_values($state)[0] ?? null) : $state)
                            ->helperText('Stored in public/images/activities. Use a genuine activity photo, not an illustration.'),
                        FileUpload::make('gallery')
                            ->label('Additional images')
                            ->disk('portfolio')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->maxSize(4096)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->dehydrateStateUsing(fn ($state) => is_array($state) ? array_values($state) : $state),
                        TextInput::make('image_alt_en')
                            ->label('Image alt text (English)')
                            ->maxLength(220),
                        TextInput::make('image_alt_id')
                            ->label('Image alt text (Indonesian)')
                            ->maxLength(220),
                        TextInput::make('image_label_en')
                            ->label('Image label (English)')
                            ->maxLength(120)
                            ->placeholder('Activity documentation'),
                        TextInput::make('image_label_id')
                            ->label('Image label (Indonesian)')
                            ->maxLength(120)
                            ->placeholder('Dokumentasi kegiatan'),
                        TextInput::make('evidence_url')
                            ->label('Evidence URL')
                            ->url()
                            ->maxLength(2048),
                        Repeater::make('technologies')
                            ->label('Technologies / keywords')
                            ->simple(TextInput::make('item')->required())
                            ->addActionLabel('Add technology')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
