<?php

namespace App\Models;

use App\Traits\GlobalMutators;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class CarModel extends Model
{
    use HasTranslations, GlobalMutators, HasFactory;

    protected $table = "models";
    public $translatable = ['model'];

    /**
     * Get the manufacture.
     */
    public function manufacture(): BelongsTo
    {
        return $this->belongsTo(Manufacture::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query): mixed
    {
        return $query->where('is_active', true);
    }
}
