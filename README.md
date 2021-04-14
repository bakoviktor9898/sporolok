# Sporolok

## Initial Database Migration and Seeding

```bash
sail artisan migrate --seed
sail artisan data:seed address
sail artisan data:seed shop
```

## Index creation for full text search

```bash
sail artisan scout:index shops_index
sail artisan scout:import "App\Models\Shop"

sail artisan scout:index products_index
sail artisan scout:import "App\Models\Price"
```

```bash
sail artisan migrate --seed && sail artisan data:seed address && sail artisan data:seed shop && sail artisan scout:import "App\Models\Shop" && sail artisan scout:import "App\Models\Price"
```