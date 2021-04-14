<?php

return [

    /*
    |--------------------------------------------------------------------------
    | HERE Maps API Key
    |--------------------------------------------------------------------------
    |
    | Application credentials can be used to develop using the
    | HERE Maps API for JavaScript (version 3.1 and higher).
    |
    */

    'api_key' => env('HERE_MAPS_API_KEY', null),

    /*
    |--------------------------------------------------------------------------
    | HERE Maps Discover Endpoint
    |--------------------------------------------------------------------------
    |
    | This value determines the API endpoint used by the HERE Maps Discover
    | service.
    |
    */

    'discover_api' => env('HERE_MAPS_DISCOVER_API', "https://geocode.search.hereapi.com/v1/geocode"),

    /*
    |--------------------------------------------------------------------------
    | HERE Maps Lookup API Endpoint
    |--------------------------------------------------------------------------
    |
| This value determines the API endpoint used by the HERE Maps Lookup
    | service.
    |
    */

    'lookup_api' => env('HERE_MAPS_LOOKUP_API', "https://lookup.search.hereapi.com/v1/lookup")
]

?>
