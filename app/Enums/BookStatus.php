<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

final class BookStatus extends Enum
{
    #[Description('User wait to pick up')]
    const WAIT_TO_PICK_UP = 0;
    #[Description('User is borrowing')]
    const BORROWING = 1;
    #[Description('Available')]
    const RETURNED = 2;
    #[Description('User is borrowing, but it is out of borrowing time')]
    const EXPIRED = 3;

    public static function getEndUserDescription($status): string
    {
        return match ($status) {
            self::WAIT_TO_PICK_UP => 'This book is waiting to be picked up',
            self::BORROWING => 'You are borrowing this book',
            self::EXPIRED => 'You are borrowing this book, but it expired, please return back',
            default => 'Available',
        };
    }

}
