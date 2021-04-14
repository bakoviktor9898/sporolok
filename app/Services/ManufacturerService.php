<?php

namespace App\Services;

use App\Http\Filters\ManufacturerFilter;
use App\Models\Manufacturer;
use Illuminate\Support\Collection;

class ManufacturerService extends Service
{
    /**
     * Create new service instance
     *
     * @param Manufacturer $model
     * @return void
     */
    public function __construct(Manufacturer $model)
    {
        parent::__construct($model);
    }

    /**
     * Return all associated from the database
     * after applying filters
     *
     * @param ManufacturerFilter $filter
     * @return Collection
     */
    public function all(ManufacturerFilter $filter): Collection
    {
        return $this->model->query()
            ->filter($filter)
            ->get();
    }
}
