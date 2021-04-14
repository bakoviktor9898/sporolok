<?php

namespace App\Services\Actions\Manufacturer;

use App\Models\Manufacturer;
use App\Models\Price;
use App\Services\Actions\Action;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UpdateOrCreate extends Action
{
    /**
     * Create a new action instance
     *
     * @param Price $model
     * @return void
     */
    public function __construct(Manufacturer $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Manufacturer
     */
    function execute(array &$data): ?Manufacturer
    {
        $manufacturer = $this->model->updateOrCreate([
            'name'          =>$data['manufacturerName'],   
            'short_name'    =>$data['manufacturerShortName']   
        ]);

        $data = Arr::add($data, 'manufacturer_id', $manufacturer->id);

        return $manufacturer;
    }
}