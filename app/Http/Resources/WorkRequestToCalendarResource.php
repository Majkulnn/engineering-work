<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkRequestToCalendarResource extends JsonResource
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
            "resourceId" => $this->creator_id,
            "start" => Carbon::create($this->date)->setTimeFromTimeString($this->from),
            "end" => Carbon::create($this->date)->setTimeFromTimeString($this->to),
            "display" => "background",
            "color" => "blue",
        ];
    }
}
