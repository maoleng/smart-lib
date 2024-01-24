<?php

namespace App\Console\Commands;

use App\Enums\BookStatus;
use App\Mail\OverdueReminderMail;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OverdueBookReminderCommand extends Command
{

    protected $signature = 'app:mail-overdue-book';

    protected $description = 'Send mail to user who has out of time to borrow book';

    public function handle(): void
    {
        $users = User::query()->whereHas('borrows', function ($q) {
            $q->where('expected_return_at', '<', now())->whereNull('actual_return_at');
        })->with(['borrows' => function ($q) {
            $q->where('expected_return_at', '<', now())->whereNull('actual_return_at')->with('bookInstance.book');
        }])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new OverdueReminderMail($user->name, $user->borrows));
            $user->borrows->update(['status' => BookStatus::EXPIRED]);
        }
    }
}
