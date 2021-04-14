<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManufacturerRequest;
use App\Models\Manufacturer;
use App\Services\Admin\ManufacturerService;
use Illuminate\Http\Request;

class ProductManufacturerController extends Controller
{
    protected $service;
    public function __construct(ManufacturerService $service)
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
        $manufacturers = $this->service->get();
        return view('admin.manufacturer.index',[
            'manufacturers' =>$manufacturers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AdminManufacturerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminManufacturerRequest $request)
    {
        $data = $request->validated();
        $this->service->create($data);

        return route('manufacturer.index');
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
        $manufacturer = $this->service->find($id);
        return view('admin.manufacturer.edit',[
            'manufacturer' => $manufacturer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $data = $request->validated();
        $this->service->update($manufacturer,$data);

        return route('manufacturer.index');
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
