<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\EmploymentForm;
use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email", Rule::unique("users", "email")->ignore($this->user)],
            "role" => ["required", new Enum(Role::class)],
            "position" => ["required"],
            "employment_form" => ["required", new Enum(EmploymentForm::class)],
            "employment_date" => ["required", "date_format:Y-m-d"],
        ];
    }

    public function userData(): array
    {
        return [
            "email" => $this->get("email"),
            "role" => $this->get("role"),
        ];
    }

    public function userProfileData(): array
    {
        return [
            "first_name" => $this->get("first_name"),
            "last_name" => $this->get("last_name"),
            "position" => $this->get("position"),
            "employment_form" => $this->get("employment_form"),
            "employment_date" => $this->get("employment_date"),
        ];
    }
}
