<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->profile->first_name,
            "last_name" => $this->profile->last_name,
            "email" => $this->email,
            "role" => $this->role,
            "position" => $this->profile->position,
            "employment_form" => $this->profile->employment_form,
            "employment_date" => $this->profile->employment_date->toDateString(),
        ];
    }
}
