<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}
