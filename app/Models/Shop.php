<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Address;
use App\Models\ShopName;
use Laravel\Scout\Searchable;

class Shop extends Model
{
    use HasFactory, Filterable, Searchable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'address_id',
        'shop_name_id',
        'here_map_id'
    ];

    /**
     * Get the Address associated with the Shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the ShopName associated with the Shop
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function name(): BelongsTo
    {
        return $this->belongsTo(ShopName::class, 'shop_name_id', 'id');
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'shops_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['shop_name']     = $this->name->toArray();
        $array['address']       = $this->address->toArray();
        $array['postal_code']   = $this->address->postalCode->toArray();
        $array['city']          = $this->address->postalCode->city->toArray();

        return $array;
    }
}
