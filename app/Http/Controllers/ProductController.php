<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductCreateRequest;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Service object of the controller
     *
     * @var ProductService $service
     */
    protected ProductService $service;


    /**
     * Create a shop controller
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductFilter $filter)
    {
        $data = $this->service->all($filter);

        if ($filter->request->expectsJson())
            return response()->json($data);

            
            
        return view('product.index', [
            'products'      => $data,
            'searchText'    => $filter->request->q,
            'manufacturers' => Manufacturer::all(),
            'categories'    => Category::all(),
            'shoppingList'  => auth()->user() ? auth()->user()->prices->pluck('id')->toArray() : [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        $product = $this->service->create($data);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('components.product.show', [
            'price'=>  $this->service->get($id),
            'shoppingList' => auth()->user() ? auth()->user()->prices->pluck('id')->toArray() : []
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
