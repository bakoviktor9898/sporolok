<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\Shop;

use Illuminate\Support\Arr;

class CreateShop extends Action
{
    /**
     * Create a new action instance
     *
     * @param Shop $model
     * @return void
     */
    public function __construct(Shop $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve Shop if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|Shop
     */
    public function execute(array &$data): ?Shop
    {
        if (!Arr::exists($data, 'shop_name_id') ||
            !Arr::exists($data, 'address_id') ||
            !Arr::exists($data, 'here_map_id'))

            return null;

        $shop = $this->model->firstOrCreate([
            'shop_name_id'  => $data['shop_name_id'],
            'address_id'    => $data['address_id'],
            'here_map_id'   => $data['here_map_id'],
        ]);

        $data = Arr::add($data, 'shop_id', $shop->id);

        return $shop;
    }
}
