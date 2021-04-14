<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Product;
use Illuminate\Support\Arr;

class CreateProduct extends Action
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
     * @param array $data
     * @return null|Product
     */
    function execute(array &$data): ?Product
    {
        $product = $this->model->firstOrCreate([
            'name'              => $data['product_name'],
            'manufacturer_id'   => $data['manufacturer_id'],
            'category_id'       => $data['category_id']
        ]);

        $data = Arr::add($data, 'product_id', $product->id);

        return $product;
    }
}
