<?php

namespace App\Filament\Resources\BeyondSkills\Pages;

use App\Filament\Resources\BeyondSkills\BeyondSkillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBeyondSkill extends EditRecord
{
    protected static string $resource = BeyondSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
