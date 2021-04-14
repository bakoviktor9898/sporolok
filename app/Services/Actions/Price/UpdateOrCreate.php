<?php

namespace App\Services\Actions\Price;

use App\Models\Price;
use App\Services\Actions\Action;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class UpdateOrCreate extends Action
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
        $price->update([
            'price'         => $data['price'],
            'quantity'      => $data['quantity'],
            'currency_id'   => $data['currency_id'],
            'per'           => $data['per'],
            'added_at'      => Carbon::now()
        ]);

        return $price;
    }
}