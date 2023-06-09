<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Role;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $email
 * @property string $password
 * @property Role $role
 * @property Profile $profile
 */

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "email",
        "password",
        "role",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "email_verified_at" => "datetime",
        "role" => Role::class,
    ];

    protected $with = [
        "profile",
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function holidaysRequest(): HasMany
    {
        return $this->hasMany(HolidaysRequest::class, "creator_id");
    }

    public function holidays(): HasMany
    {
        return $this->hasMany(Holiday::class);
    }

    public function workTimes(): HasMany
    {
        return $this->hasMany(WorkTime::class);
    }

    public function workRequests(): HasMany
    {
        return $this->hasMany(WorkRequest::class, "creator_id");
    }
}
