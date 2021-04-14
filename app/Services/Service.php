<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class Service {

    /**
     * The model associated to the service
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected Model $model;

    /**
     * Create a new service.
     *
     * @param  Model  $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

}
