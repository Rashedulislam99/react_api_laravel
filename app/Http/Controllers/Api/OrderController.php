<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with("customer")->get();
        return response()->json(compact("orders"), 200);
    }

    /**
     * Store a newly created resource in storage.
     */



      public function invoice($id)
    {
        $order = Order::find($id);
        $order_details = OrderDetail::with('product')->where("order_id", "=", $id)->get();
        $customer = Customer::find($order->customer_id);
        return response()->json(compact("order", "order_details", "customer"));
    }



      public function orderData()
    {
        $products = Product::all();
        $customers = Customer::all();
        return response()->json(compact("products", "customers"));
    }

public function react_order_save(Request $request)
{
    try {

        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier['id'] ?? null;
        $purchase->address = $request->address;
        $purchase->sub_total = $request->summary['subtotal'] ?? 0;
        $purchase->discount_amount = $request->summary['discount'] ?? 0;
        $purchase->net_total = $request->summary['total'] ?? 0;
        $purchase->save();


        foreach ($request->cartItems as $item) {

            $purchase->purchaseDetails()->create([
                'product_id' => $item['id'],
                'qty' => $item['qty'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'subtotal' => ($item['qty'] * $item['price']) - $item['discount'],
            ]);


            $stock = new Stock();
            $stock->product_id = $item['id'];
            $stock->qty = $item['qty'];
            $stock->transaction_type_id = 2;
            $stock->remark = "Purchase Invoice #{$purchase->id}";
            $stock->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Purchase saved and stock updated!',
            'purchase_id' => $purchase->id,
        ]);
    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Error saving purchase: ' . $e->getMessage(),
        ], 500);
    }
}


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
