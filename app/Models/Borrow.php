<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrow extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_instance_id',
        'book_at',
        'borrow_at',
        'expected_return_at',
        'actual_return_at',
    ];

    public function bookInstance(): BelongsTo
    {
        return $this->belongsTo(BookInstance::class);
    }

}
