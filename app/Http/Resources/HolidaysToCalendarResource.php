<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HolidaysToCalendarResource extends JsonResource
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
            "resourceId" => $this->user->id,
            "start" => $this->start_date->toDateString(),
            "end" => $this->end_date->addDay()->toDateString(),
            "forceEventDuration" => true,
            "display" => "background",
            "color" => "red",
            "allDay" => true,
        ];
    }
}
