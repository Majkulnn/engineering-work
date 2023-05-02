<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\EmploymentForm;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

/**
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 */
class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "email" => ["required", "string", "email", "unique:users"],
            "first_name" => ["required", "string"],
            "last_name" => ["required", "string"],
            "position" => ["required", "string"],
            "employment_form" => ["required", new Enum(EmploymentForm::class)],
            "employment_date" => ["required", "date_format:Y-m-d"],
        ];
    }
}
