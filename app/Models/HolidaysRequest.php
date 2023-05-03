<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HolidayRequestStatus;
use App\Enums\HolidaysType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/*
 * @property int $id
 * @property HolidaysType $type
 * @property HolidaysRequestStatus $status
 * @property Carbon $start_date
 * @property Carbon $$end_date
 * @property string $reason
 * @property User $creator
 */
class HolidaysRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "type" => HolidaysType::class,
        "status" => HolidayRequestStatus::class,
        "start_date" => "date",
        "end_date" => "date",
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
