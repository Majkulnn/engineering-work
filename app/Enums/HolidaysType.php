<?php

declare(strict_types=1);

namespace App\Enums;

enum HolidaysType: string
{
    case OnRequest = "on_request";
    case Childcare = "childcare_vacation";
    case Unpaid = "unpaid_vacation";
    case Volunteering = "volunteering_vacation";
    case Sick = "sick_vacation";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = collect(HolidaysType::cases());

        return $cases->map(
            fn(HolidaysType $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }
}
