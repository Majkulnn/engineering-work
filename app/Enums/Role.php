<?php

declare(strict_types=1);

namespace App\Enums;

enum Role: string
{
    case Administrator = "administrator";
    case Manager = "manager";
    case Employee = "employee";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = collect(Role::cases());

        return $cases->map(
            fn(Role $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }
}
