<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        return view('app.index', [
            'books' => Book::with(['author', 'category'])->paginate(9),
        ]);
    }

}
