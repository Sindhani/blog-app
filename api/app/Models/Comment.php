<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['content', 'user_id', 'blog_id'];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }


    public function createdAt(): Attribute
    {
        return Attribute::make(
            fn($value) => Carbon::parse($value)->diffForHumans()
        );
    }

    protected function casts(): array
    {
        return [
            'content' => 'encrypted'
        ];
    }
}
