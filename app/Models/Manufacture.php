<?php

namespace App\Models;

use App\Traits\GlobalMutators;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Manufacture extends Model
{
    use HasTranslations, GlobalMutators, HasFactory;

    public $translatable = ['manufacture'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('is_active', true);
    }

}
