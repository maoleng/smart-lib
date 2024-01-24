<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookStatus extends Enum
{
    const WAIT_TO_PICK_UP = 0;
    const NOT_PICK_UP = 1;
    const BORROWING = 2;
    const RETURNED = 3;
    const EXPIRED = 4;

}
