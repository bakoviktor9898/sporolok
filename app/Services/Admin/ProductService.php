<?php

namespace App\Services\Admin;

use App\Models\Price;
use App\Services\Actions\Currency\UpdateOrCreate as CurrencyUpdate;
use App\Services\Actions\Price\UpdateOrCreate as PriceUpdate;
use App\Services\Actions\Manufacturer\UpdateOrCreate as ManufacturerUpdate;
use App\Services\Actions\Category\UpdateOrCreate as CategoryUpdate;
use App\Services\Actions\Product\UpdateOrCreate as ProductUpdate;
use App\Services\Service;
use Illuminate\Support\Facades\Log;

class ProductService extends Service
{
    /**
     * Update or create action for currency model
     * 
     * @var App\Services\Actions\Currency\UpdateOrCreate
     */
    private CurrencyUpdate $currencyUpdate;

    /**
     * Update or create action for currency model
     * 
     * @var App\Services\Actions\Manufacturer\UpdateOrCreate
     */
    private ManufacturerUpdate $manufacturerUpdate;

    /**
     * Update or create action for currency model
     * 
     * @var App\Services\Actions\Category\UpdateOrCreate
     */
    private CategoryUpdate $categoryUpdate;

    /**
     * Update or create action for currency model
     * 
     * @var App\Services\Actions\Product\UpdateOrCreate
     */
    private ProductUpdate $productUpdate;

    /**
     * Update or create action for price model
     * 
     * @var App\Services\Actions\Price\UpdateOrCreate
     */
    private PriceUpdate $priceUpdate;

    

    /**
     * Create a new admin product service.
     *
     * @param  Price  $model
     * @return void
     */
    public function __construct(Price $price,
                                CurrencyUpdate $currencyUpdate,
                                PriceUpdate $priceUpdate,
                                ManufacturerUpdate $manufacturerUpdate,
                                CategoryUpdate $categoryUpdate,
                                ProductUpdate $productUpdate,
                                )
    {
        $this->model = $price;
        $this->currencyUpdate = $currencyUpdate;
        $this->priceUpdate = $priceUpdate;
        $this->manufacturerUpdate = $manufacturerUpdate;
        $this->categoryUpdate = $categoryUpdate;
        $this->productUpdate = $productUpdate;
        
        
    }

    /**
     * Update product based on the given data
     * 
     * @param array $data
     * @return Price
     */
    public function update(array $data): Price
    {
        $this->currencyUpdate->execute($data);
        $prices =  $this->priceUpdate->execute($data);
        $this->manufacturerUpdate->execute($data);
        $this->categoryUpdate->execute($data);
        $product = $this->productUpdate->execute($data);

        return $prices;
    }
}