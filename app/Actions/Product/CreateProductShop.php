<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\ProductShop;
use Illuminate\Support\Arr;

class CreateProductShop extends Action
{
    /**
     * Create a new action instance
     *
     * @param ProductShop $model
     * @return void
     */
    public function __construct(ProductShop $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|ProductShop
     */
    function execute(array &$data): ?ProductShop
    {
        $productShop = $this->model->firstOrCreate([
            'product_id'    => $data['product_id'],
            'shop_id'       => $data['shop_id'],
            'price_id'      => $data['price_id']
        ]);

        $data = Arr::add($data, 'product_shop_id', $productShop->id);

        return $productShop;
    }
}
