<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Arr;

class UpdateProductManufacturer extends Action
{
    /**
     * Create a new action instance
     *
     * @param Product $model
     * @return void
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * Required properties of data array
     *  [
     *      product => [
     *          id => '12345'
     *      ],
     *      manufacturer => [
     *          name        => 'Example Company',
     *          short_name  => 'Example'
     *      ]
     *  ]
     *
     * @param array $data
     * @return null|Product
     */
    function execute(array &$data): ?Product
    {
        $product = $this->model->find(Arr::get($data, 'product.id'));

        $manufacturer = $this->model
            ->manufacturer()
            ->firstOrCreate([
                'name'          => Arr::get($data, 'manufacturer.name'),
                'short_name'    => Arr::get($data, 'manufacturer.short_name')
            ]);

        $product->manufacturer()
            ->associate($manufacturer);

        Arr::set($data, 'manufacturer.id', $manufacturer->id);
        return $manufacturer;
    }
}
