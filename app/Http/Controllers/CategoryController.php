<?php

namespace App\Http\Controllers;

use App\Http\Filters\CategoryFilter;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Service object of the controller
     *
     * @var CategoryService
     */
    protected CategoryService $service;

    /**
     * Create a shop controller
     */
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryFilter $filter)
    {
        return response()->json(
            $this->service->all($filter)
        );
    }
}
