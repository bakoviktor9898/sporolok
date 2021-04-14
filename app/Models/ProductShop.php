<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Price;

class ProductShop extends Model
{
    use HasFactory;

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
        'product_id',
        'shop_id',
        'price_id'
    ];

    /**
     * Get the Product associated with the ProductShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }

    /**
     * Get the Shop associated with the ProductShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class);
    }

    /**
     * Get the Price associated with the ProductShop
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function price(): HasOne
    {
        return $this->hasOne(Price::class);
    }
}
