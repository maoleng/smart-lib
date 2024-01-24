<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookStatus extends Enum
{
    const WAIT_TO_PICK_UP = 0;
    const NOT_PICK_UP = 1;
    const BORROWING = 2;
    const RETURNED = 3; //available
    const EXPIRED = 4;

    public static function getBookStatusDescription($status): string
    {
        return match ($status) {
            self::WAIT_TO_PICK_UP => 'Wait to pick up',
            self::BORROWING => 'Borrowing',
            self::EXPIRED => 'Borrowing (Please return book)',
            default => 'Available',
        };
    }

}
