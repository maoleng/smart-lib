<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

final class UserRole extends Enum
{

    #[Description('User')]
    const USER = 0;

    #[Description('Admin')]
    const ADMIN = 1;

}
