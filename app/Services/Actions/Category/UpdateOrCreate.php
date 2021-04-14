<?php

namespace App\Services\Actions\Category;

use App\Models\Category;
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
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * @param array $data
     * @return null|Category
     */
    function execute(array &$data): ?Category
    {
        $category = $this->model->updateOrCreate([
            'name' => $data['categoryName']
        ]);

        $data = Arr::add($data, 'category_id', $category->id);

        return $category;
    }
}