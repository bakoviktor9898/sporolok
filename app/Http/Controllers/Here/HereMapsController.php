<?php

namespace App\Http\Controllers\Here;

use App\Http\Controllers\Controller;
use App\Http\Requests\Here\DiscoverRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class HereMapsController extends Controller
{
    /**
     * Discover a place by its given name using the HERE Maps's
     * Geolocation API
     *
     * @param DiscoverRequest $request
     * @return JsonResponse
     */
    public function discover(DiscoverRequest $request): JsonResponse
    {
        $response = Http::get(
            config('here.discover_api'),
            $request->validated()
        )->json();

        // Add custom label to array items
        $places = collect(Arr::get($response, 'items'))
            ->map(function ($shop, $id) {
                $label = Arr::get($shop, 'address.label');
                return Arr::add($shop, 'label', $label);
            });

        // Remove places without houseNumber or address provided
        $places = $places->filter(function($place, $key) {
            return Arr::has($place, ['address.street', 'address.houseNumber']);
        })->values();

        return response()->json($places);
    }
}
