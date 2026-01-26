<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $stocks = Stock::with("product")->get();
        return response()->json(compact("stocks"), 200);
    }



public function low_stock()
{
    $stocks = Stock::with('product')
        ->select('product_id')
        ->selectRaw('SUM(qty) as total_qty')
        ->where('qty', '<=', 10)
        ->groupBy('product_id')
        ->get();

    return response()->json([
        'stocks' => $stocks
    ], 200);
}



public function over_stock()
{
  $stocks = Stock::with('product')
    ->select('product_id',)
    ->selectRaw('SUM(qty) as total_qty')
    ->where('qty', '>=', 50)
    ->groupBy('product_id')
    ->get();

    return $stocks;
    return response()->json([
        'stocks' => $stocks
    ], 200);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
