<?php

namespace App\Actions;
use App\Models\Product;
use Illuminate\Support\Arr;

class UpdateProductCategory extends Action
{
    /**
     * Create a new action instance
     *
     * @param Product $model
     * @return void
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Execute the action
     *
     * Required properties of data array
     *  [
     *      product => [
     *          id => '12345'
     *      ],
     *      category => [
     *          name        => 'Tejek',
     *          parent_id   => '3'
     *      ]
     *  ]
     *
     * @param array $data
     * @return null|Product
     */
    function execute(array &$data): ?Product
    {
        $product = $this->model->find(Arr::get($data, 'product.id'));

        $category = $product
            ->category()
            ->firstOrCreate([
                'name'      => Arr::get($data, 'category.name'),
                'parent_id' => Arr::get($data, 'category.parent_id')
            ]);

        $product
            ->category()
            ->associate($category);

        Arr::put($data, 'category.id', $category->id);

        return $product;
    }
}
