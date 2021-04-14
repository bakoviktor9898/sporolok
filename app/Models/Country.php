<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\State;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'code'];

    /**
     * Get all of the state for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function state(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
