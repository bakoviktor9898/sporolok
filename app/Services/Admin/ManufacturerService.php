<?php

namespace App\Services\Admin;

use App\Models\Manufacturer;
use App\Services\Service;
use Illuminate\Support\Collection;

class ManufacturerService extends Service
{
    /**
     * Create a new admin product service.
     *
     * @param  Manufacturer  $model
     * @return void
     */
    public function __construct(Manufacturer $model)
    {
        $this->model = $model;
    }

    /**
     * Return all categories
     * 
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->model->all();
    }

    /**
     * Retrieve a model by it's ID
     * 
     * @return null|Manufacturer
     */
    public function find($id): ?Manufacturer
    {
        return $this->model->find($id);
    }

    public function update(Manufacturer $category, array $data): Manufacturer
    {
        $category->update($data);
        return $category;
    }

    

    public function create(array $data): Manufacturer
    {
       return $this->model->create($data);
        
    }
}