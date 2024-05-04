<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountVerificationCode extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'otp',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
