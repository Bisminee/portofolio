<?php

namespace App\Filament\Resources\BeyondSkills\Pages;

use App\Filament\Resources\BeyondSkills\BeyondSkillResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBeyondSkills extends ListRecords
{
    protected static string $resource = BeyondSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
