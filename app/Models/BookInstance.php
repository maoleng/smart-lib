<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookInstance extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'status',
        'book_id',
    ];

}
