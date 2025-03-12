<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['lang', 'category_id', 'auther_id', 'slug', 'image', 'title', 'content', 'meta_title', 'meta_description', 'tags', 'is_breaking_news', 'show_at_slider', 'show_at_popular', 'status', 'view', 'is_approved'];

    public function scopeActiveEntries($query)
    {
        return $query->where('status', 1)->where('is_approved', 1);
    }

    public function scopeWithLanguage($query)
    {
        $language = getLanguage();
        return $query->where('lang', $language);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'auther_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(related: Comment::class);
    }
}
