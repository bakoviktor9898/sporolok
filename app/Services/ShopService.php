<?php

namespace App\Services;

use App\Http\Filters\ShopFilter;
use App\Models\Shop;
use Illuminate\Support\Collection;
use App\Actions\Shop\CreateCountry;
use App\Actions\Shop\CreateState;
use App\Actions\Shop\CreateCounty;
use App\Actions\Shop\CreateCity;
use App\Actions\Shop\CreatePostalCode;
use App\Actions\Shop\CreateAddress;
use App\Actions\Shop\CreateShopName;
use App\Actions\Shop\CreateShop;
use Illuminate\Database\Eloquent\Builder;

class ShopService extends Service {

    /**
     * Action for creating a country
     *
     * @var CreateCountry
     */
    protected CreateCountry $createCountry;

    /**
     * Action for creating a state
     *
     * @var CreateState
     */
    protected CreateState $createState;

    /**
     * Action for creating a country
     *
     * @var CreateCounty
     */
    protected CreateCounty $createCounty;

    /**
     * Action for creating a country
     *
     * @var CreateCity
     */
    protected CreateCity $createCity;

    /**
     * Action for creating a country
     *
     * @var CreatePostalCode
     */
    protected CreatePostalCode $createPostalCode;

    /**
     * Action for creating a country
     *
     * @var CreateAddress
     */
    protected CreateAddress $createAddress;

    /**
     * Action for creating a country
     *
     * @var CreateShopName
     */
    protected CreateShopName $createShopName;

    /**
     * Action for creating a country
     *
     * @var CreateShop
     */
    protected CreateShop $createShop;

    /**
     * Service for interacting with address models
     * 
     * @var AddressService
     */
    protected AddressService $addressService;

    /**
     * Create a new shop service.
     *
     * @param  Shop  $model
     * @param CreateCountry $createCountry
     * @param CreateState $createState
     * @param CreateCounty $createCounty
     * @param CreateCity $createCity
     * @param CreatePostalCode $createPostalCode
     * @param CreateAddress $createAddress
     * @param CreateShopName $createShopName
     * @param CreateShop $createShop
     * @return void
     */
    public function __construct(Shop $model,
                                CreateCountry $createCountry,
                                CreateState $createState,
                                CreateCounty $createCounty,
                                CreateCity $createCity,
                                CreatePostalCode $createPostalCode,
                                CreateAddress $createAddress,
                                CreateShopName $createShopName,
                                CreateShop $createShop,
                                AddressService $addressService)
    {
        parent::__construct($model);

        $this->createCountry    = $createCountry;
        $this->createState      = $createState;
        $this->createCounty     = $createCounty;
        $this->createCity       = $createCity;
        $this->createPostalCode = $createPostalCode;
        $this->createAddress    = $createAddress;
        $this->createShopName   = $createShopName;
        $this->createShop       = $createShop;
        $this->addressService   = $addressService;
    }

    /**
     * Return all associated model from database
     *
     * @param ShopFilter $filter
     * @return Collection
     */
    public function all(ShopFilter $filter): Collection
    {
        return $this->model->search($filter->request->input('q'))
            ->query(function (Builder $query) use ($filter) {
                return $query->with([
                    'address',
                    'address.postalCode',
                    'address.postalCode.city',
                    'address.postalCode.city.county',
                    'address.postalCode.city.county.state',
                    'address.postalCode.city.county.state.country'
                ])
                ->filter($filter);
            })->get();
    }

    /**
     * Return the Shop from the database,
     * or create if not exists
     *
     * @param array $data
     * @return null|Shop
     */
    public function create(array $data): ?Shop
    {
        $country    = $this->createCountry->execute($data);
        $state      = $this->createState->execute($data);
        $county     = $this->createCounty->execute($data);
        $city       = $this->createCity->execute($data);
        $postalCode = $this->createPostalCode->execute($data);
        $address    = $this->createAddress->execute($data);
        $shopName   = $this->createShopName->execute($data);
        $shop       = $this->createShop->execute($data);

        return $shop;
    }

    public function getShopsInRange(float $lat, float $lng, int $range = 20, int $limit = 20)
    {
        $addresses = $this->addressService
            ->getWithinRange($lat, $lng, $range, $limit)
            ->pluck('id');

        $shops = $this->model->whereHas('address', function (Builder $query) use ($addresses) {
            return $query->whereIn('id', $addresses);
        })->get();

        return $shops;
    }

}
