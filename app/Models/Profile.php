<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EmploymentForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = "user_id";
    protected $guarded = [];
    protected $casts = [
        "employment_form" => EmploymentForm::class,
        "employment_date" => "date",
        "birthday" => "date",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->withTrashed();
    }
}
