<?php

declare(strict_types=1);

namespace App\Enums;

enum HolidayRequestStatus: string
{
    case Pending = "PENDING";
    case Accepted = "ACCEPTED";
    case Rejected = "REJECTED";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = collect(HolidayRequestStatus::cases());

        return $cases->map(
            fn(HolidayRequestStatus $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }
}
