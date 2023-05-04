<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $creator_id
 * @property Carbon $date
 */
class WorkRequest extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "date" => "date",
    ];
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
