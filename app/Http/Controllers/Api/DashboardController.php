<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function report(Request $request)
    {
        //  Orders summary
        $ordersCount  = DB::table('orders')->count();
        $ordersTotal  = DB::table('orders')->sum('order_total');

        //  Purchases summary
        $purchasesCount = DB::table('purchases')->count();
        $purchasesTotal = DB::table('purchases')->sum('net_total');

        // Customers summary (core_customers)
        $customersCount = DB::table('customers')->count();

        return response()->json([
            'success' => true,
            'data' => [
                'orders' => [
                    'count' => (int) $ordersCount,
                    'total' => (float) $ordersTotal,
                ],
                'purchases' => [
                    'count' => (int) $purchasesCount,
                    'total' => (float) $purchasesTotal,
                ],
                'customers' => [
                    'count' => (int) $customersCount,
                ],
            ]
        ], 200);
    }
}
