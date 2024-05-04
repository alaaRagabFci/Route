<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    public $fillable = [
        'driver_license',
        'car_spec',
        'tow_truck_registeration',
        'vehicle_image',
        'vehicle_license',
        'national_id',
        'criminal_record',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
