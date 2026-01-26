<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $purchases = Purchase::with('supplier')->get();
        return response()->json(compact("purchases"), 200);
    }



       public function purchaseData()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return response()->json(compact("products", "suppliers"));
    }




    public function react_purchase_save(Request $request)
    {
        try {
            // 1️⃣ Save Purchase (header)
            $purchase = new Purchase();
            $purchase->supplier_id = $request->supplier['id'] ?? null;
            $purchase->sub_total = $request->summary['subtotal'] ?? 0;
            $purchase->discount_amount = $request->summary['discount'] ?? 0;
            $purchase->net_total = $request->summary['total'] ?? 0;
            $purchase->status_id = 1; // Optional default status
            $purchase->save();

            // 2️⃣ Save Purchase Details & Update Stock
            foreach ($request->cartItems as $item) {
                // Purchase Details
                $purchase->purchaseDetails()->create([
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['price'],
                    'discount' => $item['discount'] ?? 0,
                    'subtotal' => ($item['qty'] * $item['price']) - ($item['discount'] ?? 0),
                ]);

                // Stock Update
                $stock = new Stock();
                $stock->product_id = $item['id'];
                $stock->warehouse_id = 2; // Default warehouse
                $stock->lot_id = 2; // Default warehouse
                $stock->qty = $item['qty'];
                $stock->transaction_type_id = 2;
                $stock->remark = "Purchase Invoice #{$purchase->id}";
                $stock->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Purchase saved and stock updated!',
                'purchase_id' => $purchase->id
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to save purchase',
                'details' => $e->getMessage()
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
   public function destroy($id)
{
    Purchase::findOrFail($id)->delete();

    return response()->json([
        "success" => true,
        "message" => "Purchase deleted successfully"
    ], 200);
}

}
