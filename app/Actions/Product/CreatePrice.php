<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CreatePrice extends Action
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
        $price = $this->model->firstOrCreate([
            'price'         => $data['price'],
            'currency_id'   => $data['currency_id'],
            'quantity'      => $data['quantity'],
            'per'           => $data['per']
        ],[
            'added_at'      => Carbon::now()
        ]);

        $data = Arr::add($data, 'price_id', $price->id);

        return $price;
    }
}
