<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\User;
use App\Models\UserPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ShoppingListController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = auth()->user()->prices->pluck('id');

        if ($request->expectsJson())
            return response()->json($list, 200);

        $prices = Price::whereIn('id', $list)->get();
        $total = $prices->pluck('price')->sum();
        return view('shoppingList.index', ['prices' => $prices, 'total' => $total]);
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
     * @param $id
     */
    public function store($id)
    {
       
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user   = Auth::user();
        $price  = Price::find($id);

        $shoppingListItem = UserPrice::whereUserId($user->id)
            ->wherePriceId($price->id)
            ->first();

        if ($shoppingListItem) {
            $shoppingListItem->delete();
        }
        else {
            UserPrice::create([
                'user_id'   => $user->id,
                'price_id'  => $price->id
            ]);
        }

        if ($request->expectsJson())
            return response()->json([], 200);
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $find = UserPrice::where('price_id','=',$id);
        $find->delete();
        return redirect()->back();
    }
}
