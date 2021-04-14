<?php

namespace App\Services;

use App\Http\Filters\CategoryFilter;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryService extends Service
{
    /**
     * Create new service instance
     *
     * @param Category $model
     * @return void
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Return all associated from the database
     * after applying filters
     *
     * @param CategoryFilter $filter
     * @return Collection
     */
    public function all(CategoryFilter $filter): Collection
    {
        return $this->model->query()
            ->filter($filter)
            ->get();
    }
}
