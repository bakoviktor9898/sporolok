<?php

namespace App\Http\Controllers;

use App\Http\Filters\ManufacturerFilter;
use App\Services\ManufacturerService;

class ManufacturerController extends Controller
{
    /**
     * Service object of the controller
     *
     * @var ManufacturerService
     */
    protected ManufacturerService $service;

    /**
     * Create a shop controller
     */
    public function __construct(ManufacturerService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturerFilter $filter)
    {
        return response()->json(
            $this->service->all($filter)
        );
    }
}
