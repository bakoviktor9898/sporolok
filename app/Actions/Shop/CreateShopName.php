<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\ShopName;

use Illuminate\Support\Arr;

class CreateShopName extends Action
{
    /**
     * Create a new action instance
     *
     * @param ShopName $model
     * @return void
     */
    public function __construct(ShopName $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve ShopName if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|ShopName
     */
    public function execute(array &$data): ?ShopName
    {
        if (!Arr::exists($data, 'name'))
            return null;

        $shopName = $this->model->firstOrCreate([
            'name' => $data['name']
        ]);

        $data = Arr::add($data, 'shop_name_id', $shopName->id);

        return $shopName;
    }
}
