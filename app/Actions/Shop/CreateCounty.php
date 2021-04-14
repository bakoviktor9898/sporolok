<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\County;

use Illuminate\Support\Arr;

class CreateCounty extends Action
{
    /**
     * Create a new action instance
     *
     * @param County $model
     * @return void
     */
    public function __construct(County $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve County if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|County
     */
    public function execute(array &$data): ?County
    {
        if (!Arr::exists($data, 'county_name') ||
            !Arr::exists($data, 'state_id'))
            return null;

        $county = $this->model->firstOrCreate([
                'name'          => $data['county_name'],
                'state_id'      => $data['state_id']
        ]);

        $data = Arr::add($data, 'county_id', $county->id);

        return $county;
    }
}
