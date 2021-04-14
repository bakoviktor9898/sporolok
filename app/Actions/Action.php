<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;

abstract class Action
{
    /**
     * The action's associated model
     *
     * @var Model
     */
    protected $model;

    /**
     * Create a new Action instance
     *
     * @param Model $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Model
     */
    abstract function execute(array &$data): ?Model;
}
