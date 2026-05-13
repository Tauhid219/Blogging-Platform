<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'author_id',
        'editor_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image_path',
        'seo_title',
        'seo_description',
        'status',
        'is_featured',
        'published_at',
        'scheduled_for',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
            'scheduled_for' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(PostRevision::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function featuredImageMedia(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && filled($this->published_at) && $this->published_at->lte(now());
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if (blank($this->featured_image_path)) {
            return null;
        }

        if (filter_var($this->featured_image_path, FILTER_VALIDATE_URL) || str_starts_with($this->featured_image_path, '/')) {
            return $this->featured_image_path;
        }

        return Storage::disk('public')->url($this->featured_image_path);
    }
}
