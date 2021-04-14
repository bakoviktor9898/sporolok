<?php

namespace App\Services\Actions\ProductShop;

use App\Models\ProductShop;
use App\Services\Actions\Action;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UpdateOrCreate extends Action
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
     * @return null|Price
     */
    function execute(array &$data): ?ProductShop
    {
        $productShop = $this->model->updateOrCreate([
            'product_id'    => $data['product_id'],
            'shop_id'       => $data['shop_id'],
            'price_id'      => $data['price_id']
        ]);
        Arr::set($data, 'product_shop_id', $productShop->id);

        return $productShop;
    }
}