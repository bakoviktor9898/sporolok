<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\Address;

use Illuminate\Support\Arr;

class CreateAddress extends Action
{
    /**
     * Create a new action instance
     *
     * @param Address $model
     * @return void
     */
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve Address if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|Address
     */
    public function execute(array &$data): ?Address
    {
        if (!Arr::exists($data, 'street') ||
            !Arr::exists($data, 'house') ||
            !Arr::exists($data, 'postal_code_id') ||
            !Arr::exists($data, 'lat') ||
            !Arr::exists($data, 'lng'))
            return null;

        $address = $this->model->firstOrCreate([
            'street'            => $data['street'],
            'house'             => $data['house'],
            'postal_code_id'    => $data['postal_code_id'],
            'lat'               => $data['lat'],
            'lng'               => $data['lng']
        ]);

        $data = Arr::add($data, 'address_id', $address->id);

        return $address;
    }
}
