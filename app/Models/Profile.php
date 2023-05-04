<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmploymentForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property EmploymentForm $employmentForm
 * @property Carbon $employment_date
 */

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";
    protected $guarded = [];
    protected $casts = [
        "employment_form" => EmploymentForm::class,
        "employment_date" => "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
