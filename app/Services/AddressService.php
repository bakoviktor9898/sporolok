<?php

namespace App\Services;

use App\Models\Address;

class AddressService extends Service
{
    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve list of address from the database
     * using the Haversine formula
     * 
     * @param float $lat Latitude of the users position
     * @param float $lng Longitude of the users position
     * @param int $range Range to retrieve addresses from given in Kilometers
     * @param int $limit Number of results to be retrieved
     */
    public function getWithinRange(float $lat, float $lng, int $range = 20, int $limit = 20)
    {
        return $this->model->query()
            ->selectRaw('id, (6371 * acos (
              cos ( radians(?) )
              * cos( radians( lat ) )
              * cos( radians( lng ) - radians(?) )
              + sin ( radians(?) )
              * sin( radians( lat ) ))) AS distance', [$lat, $lng, $lat])
            ->having('distance', '<', $range)
            ->orderBy('distance')
            ->limit($limit)
            ->get();
    }
}