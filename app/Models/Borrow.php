<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_instance_id',
        'status',
        'book_at',
        'borrow_at',
        'expected_return_at',
        'actual_return_at',
    ];

}
