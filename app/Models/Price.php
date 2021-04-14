<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Scout\Searchable;

class Price extends Model
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
        'price',
        'currency_id',
        'quantity',
        'per',
        'added_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'added_at' => 'date'
    ];

    /**
     * Get the Currency that owns the Price
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the product associated with the Price
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function product(): HasOneThrough
    {
        return $this->hasOneThrough(Product::class, ProductShop::class, 'price_id', 'id', 'id', 'product_id');
    }

    /**
     * Get the shop associated with the Price
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function shop(): HasOneThrough
    {
        return $this->hasOneThrough(Shop::class, ProductShop::class, 'price_id', 'id', 'id', 'shop_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserPrice::class, 'price_id', 'id', 'id', 'user_id');
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'products_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['product']       = $this->product->toArray();
        $array['manufacturer']  = $this->product->manufacturer->toArray();
        $array['category']      = $this->product->category->toArray();
        $array['shop']          = $this->shop->toArray();
        $array['shop_name']     = $this->shop->name->toArray();
        $array['city']          = $this->shop->address->postalCode->city->toArray();

        return $array;
    }

    /**
     * Determine if the model should be searchable.
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return $this->product && $this->shop;
    }

    
}
