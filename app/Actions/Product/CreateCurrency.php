<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Currency;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateCurrency extends Action
{
    /**
     * Create a new action instance
     *
     * @param Currency $model
     * @return void
     */
    public function __construct(Currency $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Currency
     */
    function execute(array &$data): ?Currency
    {
        $currency = $this->model->firstOrCreate([
            'name'  => Str::upper($data['currency_name'])
        ]);

        $data = Arr::add($data, 'currency_id', $currency->id);

        return $currency;
    }
}
