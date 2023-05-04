<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\HolidaysType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class HolidaysRequestStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "start_date" => ["required", "date_format:Y-m-d"],
            "end_date" => ["required", "date_format:Y-m-d", "after_or_equal:start_date"],
            "type" => ["required", new Enum(HolidaysType::class)],
            "reason" => ["nullable"],
        ];
    }
}
