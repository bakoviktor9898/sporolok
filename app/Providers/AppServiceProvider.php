<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Create custom whereLike query
        Builder::macro('whereLike', function (string $attribute, string $search) {
            $this->where(function (Builder $query) use ($attribute, $search) {
                $params = explode(' ', $search);
                if (is_array($params)) {
                    foreach ($params as $param) {
                        $query->orWhere($attribute, "LIKE", "%{$param}%");
                    }
                } else {
                    $query->orWhere($attribute, "LIKE", "%{$search}%");
                }
            });
            return $this;
        });

        // WhereMatch operator for MySQL's Free Text index search
        Builder::macro('whereMatch', function (array $relations, string $search) {
            foreach ($relations as $relation => $attribute) {
                $this->whereHas($relation, function (Builder $query) use ($attribute, $search) {
                    return $query->whereRaw(
                        "MATCH({$attribute}) AGAINST(?)",
                        [$search]
                    );
                });
            }
            return $this;
        });

        // WhereMatchIn operator for MySQL's Free Text index search
        Builder::macro('whereMatchIn', function (array $arrayOfRealations, string $search) {
            foreach ($arrayOfRealations as $relations) {
                $this->orWhere(function (Builder $query) use ($relations, $search) {
                    return $query->whereMatch($relations, $search);
                });
            }
            return $this;
        });
    }
}
