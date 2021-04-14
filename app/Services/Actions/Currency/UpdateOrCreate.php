<?php

namespace App\Services\Actions\Currency;

use App\Models\Currency;
use App\Services\Actions\Action;
use Illuminate\Support\Arr;

class UpdateOrCreate extends Action
{
    /**
     * Create a new action instance
     *
     * @param Price $model
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
        $currency = $this->model->updateOrCreate([
            'name' => $data['currency']
        ]);

        $data = Arr::add($data, 'currency_id', $currency->id);

        return $currency;
    }
}