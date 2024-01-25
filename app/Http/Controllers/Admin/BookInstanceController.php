<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookInstanceRequest;
use App\Models\BookInstance;
use Illuminate\Http\RedirectResponse;

class BookInstanceController extends Controller
{

    public function store(BookInstanceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = BookStatus::RETURNED;

        BookInstance::query()->create($data);

        return back()->with('success', 'Create book instance successfully');
    }

    public function returnBook(BookInstance $book_instance): RedirectResponse
    {
        if ($book_instance->status !== BookStatus::BORROWING && $book_instance->status !== BookStatus::EXPIRED) {
            return back()->withErrors(['message', 'Invalid status']);
        }

        $book_instance->update(['status' => BookStatus::RETURNED]);
        $book_instance->borrows()->orderByDesc('book_at')->update(['actual_return_at' => now()]);

        return back()->with('success', 'Mark as returned successfully');
    }

    public function pickUpBook(BookInstance $book_instance): RedirectResponse
    {
        if ($book_instance->status !== BookStatus::WAIT_TO_PICK_UP) {
            return back()->withErrors(['message', 'Invalid status']);
        }

        $book_instance->update(['status' => BookStatus::BORROWING]);
        $book_instance->borrows()->orderByDesc('book_at')->update(['borrow_at' => now(), 'actual_return_at' => now()->addMonth()]);

        return back()->with('success', 'Mark as borrowing successfully');
    }

    public function destroy(BookInstance $book_instance): RedirectResponse
    {
        if ($book_instance->status === BookStatus::BORROWING || $book_instance->status === BookStatus::EXPIRED) {
            return back()->withErrors(['message', 'There are book that still being borrowing']);
        }
        $book_instance->borrows()->delete();
        $book_instance->delete();

        return back()->with('success', 'Delete book instance successfully');
    }

}
