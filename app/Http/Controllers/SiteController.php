<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('title', 'LIKE', "%$search%")->orWhere('ISBN', 'LIKE', "%$search%");
            });
        }

        if ($category_id = $request->get('category')) {
            $query->where('category_id', $category_id);
        }

        if ($author_id = $request->get('author')) {
            $query->where('author_id', $author_id);
        }

        $books = $query->with(['author', 'category'])->paginate(9)->withQueryString();

        return view('app.index', [
            'books' => $books,
            'authors' => Author::all(),
            'categories' => Category::all(),
        ]);
    }

}
