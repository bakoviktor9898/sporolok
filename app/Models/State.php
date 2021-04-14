<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Country;
use App\Models\County;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'country_id'];

    /**
     * Get the Country that owns the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get all of the Counties for the State
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function counties(): HasMany
    {
        return $this->hasMany(County::class);
    }
}
