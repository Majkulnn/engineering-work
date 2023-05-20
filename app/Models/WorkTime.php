<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property User $user
 * @property Carbon $start
 * @property Carbon $end
 * @property string $position
 */
class WorkTime extends Model
{
    use HasFactory;

    protected $table = "work_times";
    protected $guarded = [];
    protected $casts = [
        "start" => "datetime",
        "end" => "datetime",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
