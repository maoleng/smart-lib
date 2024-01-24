<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BorrowController extends Controller
{

    public function store(Book $book): RedirectResponse
    {
        $status = $book->status;
        if ($status !== 'Available') {
            return back()->withErrors(['message' => $status]);
        }
        $book_instance = $book->bookInstances()->where('status', BookStatus::RETURNED)->first();

        try {
            DB::beginTransaction();
            Borrow::query()->create([
                'user_id' => Auth::id(),
                'book_instance_id' => $book_instance->id,
                'book_at' => now(),
            ]);
            $book_instance->update(['status' => BookStatus::WAIT_TO_PICK_UP]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Database error: ' . $e->getMessage());

            return back()->withErrors(['message' => 'An unexpected error occurred. Please try again later']);
        }

        return back()->with('success', "You have booked $book->title successfully");
    }

}
