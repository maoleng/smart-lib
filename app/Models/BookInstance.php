<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookInstance extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'code',
        'status',
        'book_id',
    ];

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }

}
