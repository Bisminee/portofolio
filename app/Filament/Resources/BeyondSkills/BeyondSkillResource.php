<?php

namespace App\Filament\Resources\BeyondSkills;

use App\Filament\Resources\BeyondSkills\Pages\CreateBeyondSkill;
use App\Filament\Resources\BeyondSkills\Pages\EditBeyondSkill;
use App\Filament\Resources\BeyondSkills\Pages\ListBeyondSkills;
use App\Filament\Resources\BeyondSkills\Schemas\BeyondSkillForm;
use App\Filament\Resources\BeyondSkills\Tables\BeyondSkillsTable;
use App\Models\BeyondSkill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BeyondSkillResource extends Resource
{
    protected static ?string $model = BeyondSkill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Beyond Code';

    protected static ?string $recordTitleAttribute = 'name';

    protected static string|\UnitEnum|null $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return BeyondSkillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeyondSkillsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBeyondSkills::route('/'),
            'create' => CreateBeyondSkill::route('/create'),
            'edit' => EditBeyondSkill::route('/{record}/edit'),
        ];
    }
}
