<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;

class VendorOrderManagmentController extends Controller
{
    public function pushOderToShipment(Request $request)
    {
        $getResults = Order::pushOder($request->id);

        return response()->json([
            'status' => $getResults
        ]);

    }
}
