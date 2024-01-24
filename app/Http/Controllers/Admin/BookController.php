<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\UpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
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

    public function update(UpdateRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['banner'])) {
            $file = $request->file('banner');
            $data['banner'] = $file->storeAs('banners', "$book->id.{$file->extension()}");
        }

        $book->update($data);

        return back()->with('success', 'Update book successfully');
    }

}
