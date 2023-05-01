<?php

namespace App\Enums;

enum EmploymentForm: string
{
    case EmploymentContract = "employment_contract";
    case MandateContract = "mandate_contract";

    public function label(): string
    {
        return __($this->value);
    }

    public static function casesToSelect(): array
    {
        $cases = collect(EmploymentForm::cases());

        return $cases->map(
            fn(EmploymentForm $enum): array => [
                "label" => $enum->label(),
                "value" => $enum->value,
            ],
        )->toArray();
    }
}
