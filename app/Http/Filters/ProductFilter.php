<?php

namespace App\Http\Filters;

use App\Http\Requests\ProductFilterRequest;
use App\Models\Category;
use App\Services\AddressService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class ProductFilter extends Filter
{
    /**
     * @var AddressService $service
     */
    protected $addressService;

    /**
     * Create a new filter instance
     *
     * @param   Request $request
     * @return  void
     */
    public function __construct(ProductFilterRequest $request, AddressService $addressService)
    {
        parent::__construct($request);
        $this->addressService = $addressService;
    }

    /**
     * Filter the shops by the given HERE Map ID
     *
     * @param string|null $value
     * @return Builder
     */
    public function latest(string $value = "10"): Builder
    {
        return $this->builder->orderBy('added_at', 'desc')->limit($value);
    }

    /**
     * Filter products by manufacturer id
     * 
     * @param string $value
     * @return Builder
     */
    public function manufacturer(string $value = ""): Builder
    {
        return $this->builder
            ->whereHas('product.manufacturer', function (Builder $query) use ($value) {
                return $query->where('id', '=', $value);
            });
    }

    /**
     * Filter products by the given category
     * 
     * @param string $value
     * @return Builder
     */
    public function category(string $value = ""): Builder
    {
        $category       = Category::find($value);
        $categoryIds    = optional(optional($category)->descendantsAndSelf)->pluck('id');

        if ($categoryIds)
            return $this->builder
                ->whereHas('product.category', function (Builder $query) use ($categoryIds) {
                    return $query->whereIn('categories.id', $categoryIds);
                });
        
        return $this->builder;
    }

    /**
     * Filter products given by minimum price
     * 
     * @param string $value
     * @return Builder
     */
    public function priceFrom(string $value = ""): Builder
    {
        return $this->builder->where('price', '>=', $value);
    }

    /**
     * Filter products given by minimum price
     * 
     * @param string $value
     * @return Builder
     */
    public function priceTo(string $value = ""): Builder
    {
        return $this->builder->where('price', '<=', $value);
    }

    /**
     * Filter nearest shops by the given radius in kilometers
     * 
     * @param string $value Radius in kilometer
     * @return Builder
     */
    public function nearest(string $value = "20"): Builder
    {
        $nearestShops = $this->addressService->getWithinRange(
            session()->get('position.lat'),
            session()->get('position.lng'),
            $value
        )->pluck('id');

        return $this->builder->whereHas('shop.address', function (Builder $query) use ($nearestShops) {
            $query->whereIn('id', $nearestShops);
        });
    }
}
