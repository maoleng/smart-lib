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

    public function returnBook(BookInstance $book_instance): void
    {
        if ($book_instance->status !== BookStatus::BORROWING && $book_instance->status !== BookStatus::EXPIRED) {
            session()->flash('error', 'Invalid status');

            return;
        }

        $book_instance->update(['status' => BookStatus::RETURNED]);
        $book_instance->borrows()->orderByDesc('book_at')->update(['actual_return_at' => now()]);

        session()->flash('success', 'Mark as returned successfully');
    }

    public function destroy(BookInstance $book_instance): void
    {
        if ($book_instance->status === BookStatus::BORROWING || $book_instance->status === BookStatus::EXPIRED) {
            session()->flash('error', 'There are book that still being borrowing');

            return;
        }
        $book_instance->borrows()->delete();
        $book_instance->delete();

        session()->flash('success', 'Delete book instance successfully');
    }

}
