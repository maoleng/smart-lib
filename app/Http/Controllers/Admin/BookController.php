<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::query();

        $category_ids = explode(',', $request->get('category_ids'));
        if ($category_ids && $category_ids !== ['']) {
            $query->whereIn('category_id', $category_ids);
        }

        $author_ids = explode(',', $request->get('author_ids'));
        if ($author_ids && $author_ids !== ['']) {
            $query->whereIn('author_id', $author_ids);
        }

        $books = $query->with(['author', 'category'])->withCount('bookInstances')->paginate(7);

        return view('app.book.index', [
            'books' => $books,
            'categories' => Category::all(),
            'authors' => Author::all(),
        ]);
    }

}
