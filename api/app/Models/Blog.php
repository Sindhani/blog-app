<?php

namespace App\Models;

use App\Enum\BlogStatus;
use App\Traits\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;
    use Sluggable;
    use Searchable;

    protected $guarded = [];
    protected $appends = ['image_url'];

    public function publishDate(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('d/m/Y') : null,
            set: function ($value) {
                if (!$value) {
                    return null;
                }
                return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
            }
        );

    }

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? asset($this->image, app()->isProduction()) : null,
        );

    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected function casts(): array
    {
        return [
            'keywords' => 'array',
            'seo_metadata' => 'array',
            'is_scheduled' => 'boolean',
            'status' => BlogStatus::class,
        ];
    }
}
