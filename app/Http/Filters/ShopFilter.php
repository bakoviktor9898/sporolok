<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ShopFilter extends Filter
{
    /**
     * Filter the shops by the given HERE Map ID
     *
     * @param string|null $value
     * @return Builder
     */
    public function hereMapId(string $value = null): Builder
    {
        return $this->builder->where('here_map_id', '=', "{$value}");
    }

    /**
     * Filter the shops by the given city name
     *
     * @param string|null $value
     * @return Builder
     */
    public function city(string $value = null): Builder
    {
        return $this->builder->whereHas('address.postalCode.city', function (Builder $query) use ($value) {
            return $query->where('cities.name', '=', "{$value}");
        });
    }
}
