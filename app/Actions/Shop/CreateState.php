<?php

namespace App\Actions\Shop;

use App\Actions\Action;
use App\Models\State;

use Illuminate\Support\Arr;

class CreateState extends Action
{
    /**
     * Create a new action instance
     *
     * @param State $model
     * @return void
     */
    public function __construct(State $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve state if exists in the database,
     * create if not
     *
     * @param array $data
     * @return null|State
     */
    public function execute(array &$data): ?State
    {
        if (!Arr::exists($data, 'state_name') || !Arr::exists($data, 'country_id'))
            return null;

        $state = $this->model->firstOrCreate([
            'name'          => $data['state_name'],
            'country_id'    => $data['country_id']
        ]);

        $data = Arr::add($data, 'state_id', $state->id);

        return $state;
    }
}
