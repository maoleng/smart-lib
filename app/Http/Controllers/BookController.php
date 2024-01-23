<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{

    public function show($slug)
    {
        $book = Book::query()->where('slug', $slug)->firstOrFail();
        $related_books = Book::query()->limit(5)->get();

        return view('app.book-detail', [
            'book' => $book,
            'related_books' => $related_books,
        ]);
    }

}
