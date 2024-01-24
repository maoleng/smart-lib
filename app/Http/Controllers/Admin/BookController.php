<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $books = $query->with(['author', 'category'])->withCount('bookInstances')->orderByDesc('created_at')->paginate(7);

        return view('app.book.index', [
            'books' => $books,
            'categories' => Category::all(),
            'authors' => Author::all(),
        ]);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['banner'] = $request->file('banner')->store('banners');
        $data['slug'] = Str::slug($data['title']);

        Book::query()->create($data);

        return back()->with('success', 'Create book successfully');
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if (isset($data['banner'])) {
            $data['banner'] = $request->file('banner')->store('banners');
        }

        $book->update($data);

        return back()->with('success', 'Update book successfully');
    }

}
