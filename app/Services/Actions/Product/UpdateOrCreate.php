<?php

namespace App\Services\Actions\Product;

use App\Models\Price;
use App\Models\Product;
use App\Services\Actions\Action;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UpdateOrCreate extends Action
{
    /**
     * Create a new action instance
     *
     * @param Price $model
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
        $product = $this->model->find($data['product_id']);
        $product->update([
            'name'              => $data['productName'],
            'manufacturer_id'   => $data['manufacturer_id'],
            'category_id'       => $data['category_id']
        ]);

        return $product;
    }
}