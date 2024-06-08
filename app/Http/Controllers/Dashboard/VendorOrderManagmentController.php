<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Yajra\DataTables\Facades\Datatables;

class VendorOrderManagmentController extends Controller
{
    public function pushOderToShipment(Request $request)
    {
        $getResults = Order::pushOder($request->id);

        return response()->json([
            'status' => $getResults
        ]);

    }
    public function orderlist(Request $request)
    {
        if ($request->ajax()) {
            $orderItemDetails = OrderItem::query()
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->join('vendor_products', 'vendor_products.id', '=', 'order_items.product_id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('payments', 'orders.id', '=', 'payments.order_id')
                ->select(
                    'orders.order_unique_id as order_unique_id',
                    'vendor_products.product_title as product_title',
                    'vendor_products.product_banner_image as product_image',
                    \DB::raw("CONCAT(order_items.product_measurment_amount, ' ', order_items.product_measurment_unit) as product_measurment"),
                    'order_items.quantity as quantity',
                    'vendor_products.sku as productsku',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.phone_no as user_phone',


                    \DB::raw("CASE 
                    WHEN orders.currency = 'inr' THEN CONCAT('₹', orders.total_amount) 
                    WHEN orders.currency = 'usd' THEN CONCAT('$', orders.total_amount)
                    ELSE CONCAT(orders.total_amount, ' ', orders.currency) 
                     END as orders_with_currency"),
                    \DB::raw("CASE 
                                WHEN payments.currency = 'inr' THEN CONCAT('₹', payments.amount) 
                                WHEN payments.currency = 'usd' THEN CONCAT('$', payments.amount)
                                ELSE CONCAT(payments.amount, ' ', payments.currency) 
                              END as payment_with_currency"),
                    'payments.payment_method as payment_method',
                    'payments.payment_status as payment_status',
                    'orders.status as order_status',
                    \DB::raw("DATE_FORMAT(orders.created_at ,'%d/%m/%Y %H:%i:%s') AS order_date")
                )
                ->orderBy('orders.created_at', 'desc');

            return Datatables::of($orderItemDetails)
                ->addIndexColumn()
                ->addColumn('product_image', function ($row) {
                    if (isset($row->product_image)) {
                        $url = asset("product/banner/{$row->product_image}");
                    } else {
                        $url = asset("vendor_image/vendor_vector.jpeg");
                    }


                    $productimg = "<img src={$url} width='30'  height='50' />";

                    return $productimg;
                })

                ->addColumn('payment_status', function ($row) {
                    $status_text = $row->payment_status == "pending" ? 'pending' : 'success';

                    $status_btn = $row->payment_status == "pending" ? 'btn btn-warning' : 'btn btn-success';

                    $payment_status = "<button type='button' id='paymentstatuschange$row->id' onclick='paymentchangeStatus($row->id)' 
                    class='$status_btn ml-2'>$status_text</button>";

                    return $payment_status;

                })

                ->addColumn('order_status', function ($row) {

                    $status_text = $row->order_status == "" ? 'NotProcessed' : 'Inactive';

                    $status_btn = $row->order_status == "" ? 'btn btn-danger' : 'btn btn-success';

                    $order_status = "<button type='button' id='orderstatuschange$row->id' onclick='orderchangeStatus($row->id)' 
                    class='$status_btn ml-2'>$status_text</button>";

                    return $order_status;



                })








                ->rawColumns(['product_image', 'payment_status', 'order_status'])
                ->make(true);


        }

        return view('managedashboard.vendor.order.list');
    }









}
