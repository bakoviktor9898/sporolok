<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Services\Service;
use Illuminate\Support\Collection;

class CategoryService extends Service
{
    /**
     * Create a new admin product service.
     *
     * @param  Category  $model
     * @return void
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Return all categories
     * 
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->model->all();
    }

    /**
     * Retrieve a model by it's ID
     * 
     * @return null|Category
     */
    public function find($id): ?Category
    {
        return $this->model->find($id);
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category)
    {
        $children = $category->children;
        $parentId = optional($category->parent)->id;

        foreach ($children as $child) {
            $child->update([
                'parent_id' => $parentId 
            ]);
        }

        $category->delete();
    }

    public function create(array $data): Category
    {
       return $this->model->create($data);
        
    }
}