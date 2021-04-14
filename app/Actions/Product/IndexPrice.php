<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class IndexPrice extends Action
{
    /**
     * Create a new action instance
     *
     * @param Price $model
     * @return void
     */
    public function __construct(Price $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Price
     */
    function execute(array &$data): ?Price
    {
        $price = $this->model->find($data['price_id']);
        $price->searchable();

        return $price;
    }
}
