<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookStatus;
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

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('title', 'LIKE', "%$search%")->orWhere('ISBN', 'LIKE', "%$search%");
            });
        }

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

    public function show(Book $book)
    {
        $book_instances = $book->bookInstances()->paginate(9);

        return view('app.book.show', [
            'book' => $book,
            'book_instances' => $book_instances,
        ]);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['banner'] = $request->file('banner')->storePublicly('banners');
        $data['slug'] = Str::slug($data['title']);

        Book::query()->create($data);

        return back()->with('success', 'Create book successfully');
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if (isset($data['banner'])) {
            $data['banner'] = $request->file('banner')->storePublicly('banners');
        }

        $book->update($data);

        return back()->with('success', 'Update book successfully');
    }

    public function destroy(Book $book): void
    {
        if ($book->bookInstances()->whereIn('status', [BookStatus::BORROWING, BookStatus::EXPIRED])->get()->isNotEmpty()) {
            session()->flash('error', 'There are book that still being borrowing');

            return;
        }

        $book->bookInstances()->each(function ($instance) {
            $instance->borrows()->delete();
        });
        $book->bookInstances()->delete();
        $book->delete();

        session()->flash('success', 'Delete book successfully');
    }

}
