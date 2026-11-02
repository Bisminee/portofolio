<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Case file')
                    ->description('The label, ownership, and sorting of the project.')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(120)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(120)
                            ->unique(ignoreRecord: true),
                        TextInput::make('case_no')
                            ->required()
                            ->maxLength(4)
                            ->default('01'),
                        TextInput::make('subtitle')
                            ->required()
                            ->maxLength(180)
                            ->columnSpanFull(),
                        Select::make('ownership')
                            ->required()
                            ->options([
                                'Team project' => 'Team project',
                                'Coursework' => 'Coursework',
                                'Personal project' => 'Personal project',
                            ])
                            ->default('Personal project'),
                        Select::make('status')
                            ->required()
                            ->options([
                                'Published' => 'Published',
                                'In progress' => 'In progress',
                                'Archived' => 'Archived',
                            ])
                            ->default('Published')
                            ->helperText('“In progress” adds a visible badge to the public case file.'),
                        TextInput::make('year')
                            ->required()
                            ->maxLength(20),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Toggle::make('featured')
                            ->label('Feature this case file'),
                        Toggle::make('published')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Narrative')
                    ->description('Factual case-study copy. Keep interpretations clearly labelled.')
                    ->schema([
                        Textarea::make('summary')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('problem')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('solution')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Textarea::make('evidence_note')
                            ->label('Evidence note')
                            ->required()
                            ->rows(3)
                            ->helperText('State what the repository proves, and what it does not.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Case detail lists')
                    ->description('Each item becomes one bullet in the expanded case file.')
                    ->schema([
                        Repeater::make('implementation')
                            ->label('What is in the repository')
                            ->simple(TextInput::make('item')->required())
                            ->addActionLabel('Add implementation note')
                            ->columnSpanFull(),
                        TagsInput::make('tech')
                            ->label('Technologies')
                            ->separator(',')
                            ->helperText('Press Enter after each technology.')
                            ->columnSpanFull(),
                        Repeater::make('decisions')
                            ->label('Technical decisions')
                            ->simple(TextInput::make('item')->required())
                            ->addActionLabel('Add decision')
                            ->columnSpanFull(),
                        Repeater::make('challenges')
                            ->label('Challenges (optional)')
                            ->simple(TextInput::make('item')->required())
                            ->addActionLabel('Add challenge')
                            ->columnSpanFull(),
                        Repeater::make('results')
                            ->label('Verifiable results (optional)')
                            ->simple(TextInput::make('item')->required())
                            ->addActionLabel('Add result')
                            ->columnSpanFull(),
                    ]),

                Section::make('Links and artwork')
                    ->schema([
                        TextInput::make('repo_url')
                            ->label('Repository URL')
                            ->required()
                            ->url(),
                        TextInput::make('demo_label')
                            ->label('Demo link label'),
                        TextInput::make('demo_url')
                            ->label('Demo URL')
                            ->url(),
                        TextInput::make('demo_note')
                            ->label('Demo note (requirements, caveats)'),
                        TextInput::make('docs_url')
                            ->label('Documentation URL')
                            ->url(),
                        TextInput::make('art_path')
                            ->label('Artwork path')
                            ->required()
                            ->default('images/project-placeholder.svg')
                            ->helperText('Relative to /public, for example images/project-pos.svg.'),
                        Textarea::make('art_alt')
                            ->label('Artwork alt text')
                            ->required()
                            ->rows(3)
                            ->helperText('Describe the actual content. Do not describe an illustration as a screenshot.')
                            ->columnSpanFull(),
                        Select::make('art_kind')
                            ->label('Artwork type')
                            ->options([
                                'illustration' => 'Illustration (not an app screenshot)',
                                'screenshot' => 'Real application screenshot',
                            ])
                            ->default('illustration')
                            ->required()
                            ->helperText('Controls the public badge and caption.'),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
