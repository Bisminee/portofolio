<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'slug',
        'case_no',
        'title',
        'subtitle',
        'ownership',
        'status',
        'year',
        'summary',
        'problem',
        'solution',
        'implementation',
        'tech',
        'decisions',
        'challenges',
        'results',
        'repo_url',
        'demo_label',
        'demo_url',
        'demo_note',
        'docs_url',
        'art_path',
        'art_alt',
        'art_kind',
        'evidence_note',
        'featured',
        'published',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'implementation' => 'array',
            'tech' => 'array',
            'decisions' => 'array',
            'challenges' => 'array',
            'results' => 'array',
            'featured' => 'boolean',
            'published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('case_no');
    }
}
