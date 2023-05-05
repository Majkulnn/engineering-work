<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidaysResource extends JsonResource
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
            "user" => $this->user->profile->last_name,
            "start_date" => $this->start_date->toDateString(),
            "end_date" => $this->end_date->toDateString(),
            "type" => $this->type,
            "days" => $this->days_count,
        ];
    }
}
