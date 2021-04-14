<?php

namespace App\Actions\Product;

use App\Actions\Action;
use App\Models\Category;
use Illuminate\Support\Arr;

class CreateCategory extends Action
{
    /**
     * Create a new action instance
     *
     * @param Category $model
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
        $category = $this->model->firstOrCreate([
            'name' => $data['category_name']
        ]);

        $data = Arr::add($data, 'category_id', $category->id);

        return $category;
    }
}
