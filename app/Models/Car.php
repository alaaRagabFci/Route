<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'model_id',
        'registration_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
