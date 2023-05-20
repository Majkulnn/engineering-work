<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkTimeResource extends JsonResource
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
            "start" => $this->start->toDateTimeString(),
            "end" => $this->end->toDateTimeString(),
            "hour_count" => $this->hour_count,
            "position" => $this->position,
        ];
    }
}
