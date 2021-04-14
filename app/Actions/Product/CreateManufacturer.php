<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Manufacturer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateManufacturer extends Action
{
    /**
     * Create a new action instance
     *
     * @param Manufacturer $model
     * @return void
     */
    public function __construct(Manufacturer $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Manufacturer
     */
    function execute(array &$data): ?Manufacturer
    {
        $manufacturer = $this->model->firstOrCreate(
            ['name'         => $data['manufacturer_name']],
            ['short_name'   => '']
        );

        $data = Arr::add($data, 'manufacturer_id', $manufacturer->id);

        return $manufacturer;
    }
}
