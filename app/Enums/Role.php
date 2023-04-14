<?php

declare(strict_types=1);

namespace App\Enums;

enum Role: string
{
    case Administrator = "administrator";
    case Manager = "manager";
    case Employee = "employee";
}
