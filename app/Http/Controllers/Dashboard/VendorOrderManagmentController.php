<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class VendorOrderManagmentController extends Controller
{
    public function pushOderToShipment(Request $request)
    {

        $getResults = Order::pushOder($request->orderId);



        return response()->json([
            'status' => $getResults
        ]);

    }
    public function orderlist(Request $request)
    {
        if ($request->ajax()) {

            $orderItemDetails = Order::query()
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->join('payments', 'orders.id', '=', 'payments.order_id')
                ->select(
                    'orders.id as id',
                    'orders.order_unique_id as order_unique_id',
                    'users.name as user_name',
                    'users.email as user_email',
                    'users.phone_no as user_phone',
                    'payments.payment_status as payment_status',
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
                    'orders.status as order_status',
                    \DB::raw("DATE_FORMAT(orders.created_at ,'%d/%m/%Y %H:%i:%s') AS order_date")
                );


            if (isset($request->order_status) && $request->order_status == "1") {

                $orderItemDetails->where('orders.status', $request->order_status)->orderBy('orders.created_at', 'desc');

            } elseif (isset($request->order_status) && $request->order_status == "3") {

                $orderItemDetails->where('orders.status', $request->order_status)->orderBy('orders.created_at', 'desc');

            } else {
                $orderItemDetails->orderBy('orders.created_at', 'desc');

            }



            return Datatables::of($orderItemDetails)
                ->addIndexColumn()

                ->addColumn('payment_status', function ($row) {
                    $status_text = $row->payment_status == "pending" ? 'pending' : 'success';

                    $status_btn = $row->payment_status == "pending" ? 'btn btn-warning' : 'btn btn-success';

                    $payment_status = "<button type='button' id='paymentstatuschange$row->id' onclick='paymentchangeStatus($row->id)' 
                    class='$status_btn ml-2'>$status_text</button>";

                    return $payment_status;

                })

                ->addColumn('order_status', function ($row) {
                    $orderStatusMap = [
                        1 => ['text' => 'No Action Taken', 'btn' => 'btn btn-danger'],
                        2 => ['text' => 'Accepted By Vendor', 'btn' => 'btn btn-warning'],
                        3 => ['text' => 'Order Shipped', 'btn' => 'btn btn-primary'],
                        4 => ['text' => 'Order Dispatched', 'btn' => 'btn btn-info'],
                        5 => ['text' => 'Order Delivered', 'btn' => 'btn btn-success'],
                    ];

                    if (isset($orderStatusMap[$row->order_status])) {
                        $status_text = $orderStatusMap[$row->order_status]['text'];
                        $status_btn = $orderStatusMap[$row->order_status]['btn'];
                    } else {
                        // Default values if the status is not found
                        $status_text = 'Unknown Status';
                        $status_btn = 'btn btn-secondary';
                    }




                    $order_status = "<button type='button' id='orderstatuschange$row->id' onclick='orderchangeStatus($row->id)' 
                    class='$status_btn ml-2'>$status_text</button>";

                    return $order_status;



                })

                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" id="orderaction' . $row->id . '" onclick="orderaction(' . $row->id . ')" class="edit btn btn-primary mr-2" style="margin-right: 5px;"><i class="ti-write"></i></button>';

                    return $btn;
                })








                ->rawColumns(['product_image', 'payment_status', 'order_status', 'action'])
                ->make(true);


        }

        return view('managedashboard.vendor.order.list');
    }


    function userorderdetails(Request $request)
    {
        $orderItems = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('vendor_products', 'vendor_products.id', '=', 'order_items.product_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->leftJoin('order_discounts', 'orders.id', '=', 'order_discounts.order_id')
            ->leftJoin('discounts', 'discounts.id', '=', 'order_discounts.discount_id')
            ->select(
                'vendor_products.product_title as product_title',
                'vendor_products.product_banner_image as product_image',
                'vendor_products.sku as productsku',
                'orders.id as order_id',
                'orders.order_unique_id as order_unique_id',
                \DB::raw("CONCAT(order_items.product_measurment_amount, ' ', order_items.product_measurment_unit) as product_measurment"),
                \DB::raw("CASE 
                WHEN orders.currency = 'inr' THEN CONCAT('₹', orders.total_amount) 
                WHEN orders.currency = 'usd' THEN CONCAT('$', orders.total_amount)
                ELSE CONCAT(orders.total_amount, ' ', orders.currency) 
            END as orders_with_currency"),
                \DB::raw("CASE 
                WHEN orders.shipping_amount_currency = 'inr' THEN CONCAT('₹', orders.shipping_amount) 
                WHEN orders.shipping_amount_currency = 'usd' THEN CONCAT('$', orders.shipping_amount)
                ELSE CONCAT(orders.shipping_amount, ' ', orders.shipping_amount_currency) 
            END as orders_shipping_with_currency"),
                \DB::raw("CASE 
            WHEN order_items.currency = 'inr' THEN CONCAT('₹', order_items.price) 
            WHEN order_items.currency = 'usd' THEN CONCAT('$', order_items.price)
            ELSE CONCAT(order_items.price, ' ', order_items.currency) 
             END as orders_item_price_with_currency"),
                'order_items.quantity as order_quantity',
                'orders.billing_address as order_billing_address',
                'orders.billing_city as order_billing_city',
                'orders.billing_state as order_billing_state',
                'orders.billing_zip as order_billing_pincode',
                'orders.billing_country as order_billing_country',
                'orders.tracking_number as order_tracking_number',
                'orders.is_shipped as order_shipped',
                'orders.status as order_status',
                \DB::raw("DATE_FORMAT(orders.created_at ,'%d/%m/%Y %H:%i:%s') AS order_date"),
                'orders.acceptor_user_name as acceptor_user_name',
                'orders.acceptor_user_phone_no as acceptor_user_phone_no',
                'orders.shipping_address as order_shipping_address',
                'orders.shipping_city as order_shipping_city',
                'orders.shipping_state as order_shipping_state',
                'orders.shipping_country as order_shipping_country',
                'orders.shipping_zip as order_shipping_pincode',
                'orders.shipping_method as order_shipping_method',
                'users.name as sender_user_name',
                'users.email as sender_user_email',
                'users.phone_no as sender_user_phone',
                \DB::raw("CASE 
                WHEN payments.currency = 'inr' THEN CONCAT('₹', payments.amount) 
                WHEN payments.currency = 'usd' THEN CONCAT('$', payments.amount)
                ELSE CONCAT(payments.amount, ' ', payments.currency) 
            END as payment_with_currency"),
                'payments.payment_method as payment_method',
                'payments.payment_status as payment_status',
                'payments.billing_address as payment_billing_address',
                'payments.billing_state as payment_billing_state',
                'payments.billing_country as payment_billing_country',
                'payments.billing_city as payment_billing_city',
                'payments.billing_zip as payment_billing_zip',
                'payments.gateway_response as payment_gateway_response',

                'discounts.id as discount_id',
                'discounts.discount_title as discount_name',
                'discounts.discount_data as discount_data',
                'discounts.start_date as discount_start_date',
                'discounts.end_date as discount_end_date'
            )
            ->where('orders.id', $request->id)
            ->get();

        // Group and transform the data using collections
        $orderDetails = $orderItems->groupBy('order_id')->map(function ($items) {
            $order = $items->first();

            return [
                'order_id' => $order->order_id,
                'order_unique_id' => $order->order_unique_id,
                'order_billing_address' => $order->order_billing_address,
                'order_billing_city' => $order->order_billing_city,
                'order_billing_state' => $order->order_billing_state,
                'order_billing_pincode' => $order->order_billing_pincode,
                'order_billing_country' => $order->order_billing_country,
                'order_tracking_number' => $order->order_tracking_number,
                'order_shipped' => $order->order_shipped,
                'order_status' => $order->order_status,
                'order_date' => $order->order_date,
                'orders_with_currency' => $order->orders_with_currency,
                'orders_shipping_with_currency' => $order->orders_shipping_with_currency,
                'acceptor_user_name' => $order->acceptor_user_name,
                'acceptor_user_phone_no' => $order->acceptor_user_phone_no,
                'order_shipping_address' => $order->order_shipping_address,
                'order_shipping_city' => $order->order_shipping_city,
                'order_shipping_state' => $order->order_shipping_state,
                'order_shipping_country' => $order->order_shipping_country,
                'order_shipping_pincode' => $order->order_shipping_pincode,
                'order_shipping_method' => $order->order_shipping_method,
                'sender_user_name' => $order->sender_user_name,
                'sender_user_email' => $order->sender_user_email,
                'sender_user_phone' => $order->sender_user_phone,
                'payment_with_currency' => $order->payment_with_currency,
                'payment_method' => $order->payment_method,
                'payment_status' => $order->payment_status,
                'payment_shipping_address' => $order->payment_shipping_address,
                'payment_shipping_city' => $order->payment_shipping_city,
                'payment_shipping_state' => $order->payment_shipping_state,
                'payment_shipping_country' => $order->payment_shipping_country,
                'payment_shipping_pincode' => $order->payment_shipping_pincode,
                'payment_gateway_response' => $order->payment_gateway_response,

                'products' => $items->groupBy('productsku')->map(function ($productItems) {
                    $product = $productItems->first();

                    return [
                        'product_title' => $product->product_title,
                        'product_image' => $product->product_image,

                        'product_sku' => $product->productsku,
                        'order_quantity' => $product->order_quantity,
                        'product_price' => $product->orders_item_price_with_currency,
                        'product_measurment' => $product->product_measurment,

                    ];
                })->values(),
                'discounts' => $items->groupBy('discount_id')->map(function ($discountItems) {

                    $discount = $discountItems->first();
                    return [
                        'discount_id' => $discount['discount_id'],
                        'discount_name' => $discount['discount_name'],
                        'discount_data' => $discount['discount_data'],
                        'discount_start_date' => $discount['discount_start_date'],
                        'discount_end_date' => $discount['discount_end_date'],
                    ];
                })
                    ->values(),
            ];
        })->values();





        $respnseHtml = view::make('managedashboard.vendor.order.userorderdetail', ['orderDetails' => $orderDetails])->render();




        return response()->json([
            'sucess' => true,
            'orderid' => $request->id,
            'order_status' => $orderDetails[0]['order_status'],
            'responsehtml' => $respnseHtml
        ], 200);




    }





    public function orderstatuschange(Request $request)
    {
        // Find the order by ID
        $order = Order::find($request->orderId);

        // Inline custom validation
        $validator = Validator::make($request->all(), [
            'orderAccepted' => [
                'required',
                function ($attribute, $value, $fail) use ($order) {
                    if ($order->status == 3) {
                        $fail('You cannot change the order status because this order has been dispatched to the shipment company.');
                    }
                },
            ],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Update the order status
        $order->status = $request->orderAccepted;
        $order->save();

        // Return success response
        return response()->json([
            'success' => true,
            'status' => $request->orderAccepted,
        ], 200);
    }



}
