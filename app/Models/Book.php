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

    public function getStatusAttribute(): string
    {
        $book_instances = $this->bookInstances()->get();

        $user = Auth::user();
        if (!$user) {
            return $book_instances->where('status', BookStatus::RETURNED)->isEmpty()
                ? 'Unavailable'
                : 'Available';
        }

        $last_borrow = Borrow::query()->whereIn('book_instance_id', $book_instances->pluck('id')->toArray())
            ->where('user_id', $user->id)->orderByDesc('book_at')->first();

        if (!$last_borrow || $last_borrow->bookInstance->status === BookStatus::RETURNED) {
            return 'Available';
        }

        return match ($last_borrow->bookInstance->status) {
            BookStatus::WAIT_TO_PICK_UP => 'Wait to pick up',
            BookStatus::BORROWING => 'Borrowing',
            BookStatus::EXPIRED => 'Borrowing (Please return book)',
            default => 'Available',
        };
    }

}
