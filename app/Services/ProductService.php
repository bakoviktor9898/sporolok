<?php

namespace App\Services;

use App\Models\Product;
use App\Actions\Product\CreateCategory;
use App\Actions\Product\CreateCurrency;
use App\Actions\Product\CreateManufacturer;
use App\Actions\Product\CreatePrice;
use App\Actions\Product\CreateProduct;
use App\Actions\Product\CreateProductShop;
use App\Actions\Product\IndexPrice;
use App\Http\Filters\ProductFilter;
use App\Models\Price;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductService extends Service
{
    /**
     * Action for creating a category
     *
     * @var CreateCategory
     */
    protected CreateCategory $createCategory;

    /**
     * Action for creating a currency
     *
     * @var CreateCurrency
     */
    protected CreateCurrency $createCurrency;

    /**
     * Action for creating a manufacturer
     *
     * @var CreateManufacturer
     */
    protected CreateManufacturer $createManufacturer;

    /**
     * Action for creating a price
     *
     * @var CreatePrice
     */
    protected CreatePrice $createPrice;

    /**
     * Action for creating a product
     *
     * @var CreateProduct
     */
    protected CreateProduct $createProduct;

    /**
     * Action for creating a product shop association
     *
     * @var CreateProductShop
     */
    protected CreateProductShop $createProductShop;

    /**
     * Action for creating a product
     *
     * @var IndexPrice
     */
    protected IndexPrice $indexPrice;
    
    /**
     * Create a new Product service instance
     *
     * @param Price $model
     * @return void
     */
    public function __construct(Price $model,
                                CreateCategory $createCategory,
                                CreateCurrency $createCurrency,
                                CreateManufacturer $createManufacturer,
                                CreatePrice $createPrice,
                                CreateProduct $createProduct,
                                CreateProductShop $createProductShop,
                                IndexPrice $indexPrice)
    {
        parent::__construct($model);

        $this->createCategory       = $createCategory;
        $this->createCurrency       = $createCurrency;
        $this->createManufacturer   = $createManufacturer;
        $this->createPrice          = $createPrice;
        $this->createProduct        = $createProduct;
        $this->createProductShop    = $createProductShop;
        $this->indexPrice           = $indexPrice;
    }

    /**
     * Return all associated model from database
     *
     * @param ProductFilter $filter
     * @return Collection
     */
    public function all(ProductFilter $filter): Collection
    {
        return $this->model->search($filter->request->input('q'))
            ->query(function (Builder $query) use ($filter) {
                return $query->with([
                    'currency',
                    'shop.address.postalCode.city.county.state.country',
                    'shop.name',
                    'product.category',
                    'product.manufacturer'
                ])
                ->filter($filter);
            })
            ->get();
    }

    /**
     * Create a new Product model
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        $this->createCurrency->execute($data);
        $this->createManufacturer->execute($data);
        $this->createCategory->execute($data);
        $product = $this->createProduct->execute($data);
        $this->createPrice->execute($data);
        $this->createProductShop->execute($data);
        $this->indexPrice->execute($data);

        return $product;
    }

    /**
     * Return a Product by ID with it's associated
     * relations
     * 
     * @param int $id
     * @return Price
     */
    public function get(int $id): Price
    {
        return $this->model->find($id)
            ->load([
                'currency',
                'shop.address.postalCode.city.county.state.country',
                'shop.name',
                'product.category',
                'product.manufacturer'
            ]);
    }
}
