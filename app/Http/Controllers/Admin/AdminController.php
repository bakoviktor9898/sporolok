<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUpdateProductRequest;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;

class AdminController extends Controller
{
    /**
     * The service of the controller
     *
     * @var ProductService
     */
    private ProductService $service;

    /**
     * Create a new controller instance
     *
     * @param ProductService $service
     * @return void
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
    public function index()
    {
        $products = Price::with([
            'currency',
            'product',
            'product.category',
            'product.manufacturer',
            'shop',
            'shop.name',
            'shop.address',
            'shop.address.postalCode',
            'shop.address.postalCode.city',
            'shop.address.postalCode.city.county',
            'shop.address.postalCode.city.county.state',
            'shop.address.postalCode.city.county.state.country',
            

        ])
        ->whereHas('shop')->whereHas('product')
        ->get();

        return view('admin.index', [
            'prices' =>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $product = Price::find($id);
        return view('admin.edit',[
            'product' =>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AdminUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateProductRequest $request, $id)
    {
        $validated = $request->validated();
        $price = $this->service->update($validated);

        return redirect()->route('admin.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Price::find($id);
        $product->delete();
        return redirect()->back();
    }
}
