<?php

namespace App\Console\Commands;

use App\Enums\BookStatus;
use App\Mail\OverdueReminderMail;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OverduePickUpBookCommand extends Command
{

    protected $signature = 'app:update-overdue-pick-up-book';

    protected $description = 'Update book which is overdue to pick up';

    public function handle(): void
    {
        $borrows = Borrow::query()->where(DB::raw('DATE_ADD(book_at, INTERVAL 2 DAY)'), '<', now())
            ->whereNull('borrow_at')->whereNull('actual_return_at')->with('bookInstance')->get();

        foreach ($borrows as $borrow) {
            $borrow->update(['actual_return_at' => now()]);
            $borrow->bookInstance->update(['status' => BookStatus::RETURNED]);
        }
    }
}
