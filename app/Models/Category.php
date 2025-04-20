<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Builder
 */
class Category extends Model
{
    use \App\Traits\HasSlug;

    protected $casts = [
        'is_show_at_trending' => 'bool',
        'is_enable' => 'bool',
    ];

    public function getImage(string $type = 'icon'): ?string
    {
        if (!is_string($this->$type)) {
            return null;
        }

        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($this->$type)) {
            return null;
        }

        return Storage::disk('public')->url($this->$type);
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
