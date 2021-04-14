<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\PostalCode;

use Illuminate\Support\Arr;

class CreatePostalCode extends Action
{
    /**
     * Create a new action instance
     *
     * @param PostalCode $model
     * @return void
     */
    public function __construct(PostalCode $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve PostalCode if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|PostalCode
     */
    public function execute(array &$data): ?PostalCode
    {
        if (!Arr::exists($data, 'postal_code') || !Arr::exists($data, 'city_id'))
            return null;

        $postalCode = $this->model->firstOrCreate([
            'code'          => $data['postal_code'],
            'city_id'       => $data['city_id']
        ]);

        $data = Arr::add($data, 'postal_code_id', $postalCode->id);

        return $postalCode;
    }
}
