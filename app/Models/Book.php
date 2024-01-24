<?php

namespace App\Models;

use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'banner',
        'description',
        'ISBN',
        'category_id',
        'author_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function bookInstances(): HasMany
    {
        return $this->hasMany(BookInstance::class);
    }

    public function getBannerUrlAttribute()
    {
        return str_starts_with($this->banner, 'http') ? $this->banner : asset($this->banner);
    }

    public function getStatusAttribute(): string
    {
        $book_instances = $this->bookInstances;

        if ($book_instances->isEmpty()) {
            return 'Unavailable';
        }

        $has_free_book = $book_instances->where('status', BookStatus::RETURNED)->isNotEmpty();
        $user = Auth::user();
        if (!$user) {
            return $has_free_book ? 'Available' : 'Unavailable';
        }

        $last_borrow = Borrow::query()->where('user_id', $user->id)
            ->whereHas('bookInstance.book', function ($q) {
                $q->where('id', $this->id);
            })->with('bookInstance')->orderByDesc('book_at')->first();

        if (!$last_borrow) {
            return $has_free_book ? 'Available' : 'Unavailable';
        }

        return match ($status = $last_borrow->bookInstance->status) {
            BookStatus::WAIT_TO_PICK_UP, BookStatus::BORROWING, BookStatus::EXPIRED => BookStatus::getDescription($status),
            default => 'Available',
        };
    }

}
