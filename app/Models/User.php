<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $appends = ['full_name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'country_code',
        'phone',
        'status',
        'type',
        'phone_verified_at',
        'profile_image',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function isActive()
    {
        return $this->status === true;
    }

    /**
     * @return HasOne
     */
    public function verificationCode()
    {
        return $this->hasOne(AccountVerificationCode::class);
    }

    /**
     * @return HasOne
     */
    public function document()
    {
        return $this->hasOne(UserDocument::class);
    }

    /**
     * @return HasOne
     */
    public function car()
    {
        return $this->hasOne(Car::class);
    }

    /**
     * GetImage
     *
     * @param $profile_image
     * @return string|null
     */
    public function getProfileImageAttribute($profile_image): ?string
    {
        return $profile_image ? config('app.url') . '/storage/' . $profile_image : null;
    }

    /**
     * Get the user's fullname.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
