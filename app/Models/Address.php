<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PostalCode;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['street', 'house', 'postal_code_id', 'lat', 'lng'];

    /**
     * Get the postalCode that owns the Address
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postalCode(): BelongsTo
    {
        return $this->belongsTo(PostalCode::class);
    }
}
