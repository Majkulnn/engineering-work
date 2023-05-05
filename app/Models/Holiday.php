<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\HolidaysType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property HolidaysType $type
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property User $user
 */
class Holiday extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "type" => HolidaysType::class,
        "start_date" => "date",
        "end_date" => "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
