<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Activity extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'type',
        'organization',
        'role_en',
        'role_id',
        'start_date',
        'end_date',
        'is_ongoing',
        'description_en',
        'description_id',
        'highlights_en',
        'highlights_id',
        'technologies',
        'team_type',
        'location',
        'work_format',
        'evidence_url',
        'image_path',
        'gallery',
        'image_alt_en',
        'image_alt_id',
        'permission_status',
        'related_slug',
        'priority',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_ongoing' => 'boolean',
            'highlights_en' => 'array',
            'highlights_id' => 'array',
            'technologies' => 'array',
            'gallery' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('permission_status', 'approved_by_owner');
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('priority')->orderBy('name');
    }

    public function period(string $locale = 'en'): string
    {
        if (! $this->start_date) {
            return '';
        }

        $months = $locale === 'id'
            ? ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $formatMonth = function (Carbon $date) use ($months): string {
            return $months[$date->month - 1].' '.$date->format('Y');
        };

        $formatDay = function (Carbon $date) use ($months): string {
            return $date->format('j').' '.$months[$date->month - 1].' '.$date->format('Y');
        };

        if ($this->is_ongoing || ! $this->end_date) {
            return ($this->start_date->day === 1 ? $formatMonth($this->start_date) : $formatDay($this->start_date))
                .' – '.($locale === 'id' ? 'Sekarang' : 'Present');
        }

        if ($this->start_date->isSameDay($this->end_date)) {
            return $this->start_date->day === 1
                ? $formatMonth($this->start_date)
                : $formatDay($this->start_date);
        }

        $monthOnly = $this->start_date->day === 1
            && $this->end_date->day === $this->end_date->daysInMonth;

        if ($monthOnly) {
            return $formatMonth($this->start_date).' – '.$formatMonth($this->end_date);
        }

        return $formatDay($this->start_date).' – '.$formatDay($this->end_date);
    }

    protected function periodEn(): Attribute
    {
        return Attribute::get(fn (): string => $this->period('en'));
    }

    protected function periodId(): Attribute
    {
        return Attribute::get(fn (): string => $this->period('id'));
    }

    /**
     * Payload used by the existing client-side language switch.
     */
    public function translationData(): array
    {
        return [
            'role' => $this->role_id,
            'period' => $this->period('id'),
            'description' => $this->description_id,
            'highlights' => $this->highlights_id ?? [],
            'image_alt' => $this->image_alt_id,
        ];
    }
}
