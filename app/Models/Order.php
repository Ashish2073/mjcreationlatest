<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\VendorProduct;
use App\Models\Payment;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');

    }





    public static function pushOder($order_id)
    {
        $orderPushOrderDetails = [];
        $orderDetails = Order::with('order_items')->where('id', $order_id)->first()->toArray();
        $paymentDetail = Payment::where('id', $orderDetails['payment_id'])->first()->toArray();
        $userDetail = User::where('id', $orderDetails['user_id'])->first()->toArray();




        $orderPushOrderDetails['order_id'] = $orderDetails['order_unique_id'];
        $orderPushOrderDetails['order_date'] = $orderDetails['created_at'];
        $orderPushOrderDetails['pickup_location'] = 'mjcreation';
        $orderPushOrderDetails['channel_id'] = '5101820';
        $orderPushOrderDetails['comment'] = "mjcreation order";
        $orderPushOrderDetails['payment_method'] = $paymentDetail["payment_method"];
        $orderPushOrderDetails['billing_customer_name'] = $userDetail["name"];
        $orderPushOrderDetails['billing_last_name'] = "";
        $orderPushOrderDetails['billing_address'] = $orderDetails['billing_address'];
        $orderPushOrderDetails['billing_address_2'] = "";
        $orderPushOrderDetails['billing_city'] = $orderDetails["billing_city"];
        $orderPushOrderDetails['billing_state'] = $orderDetails['billing_state'];
        $orderPushOrderDetails['billing_country'] = $orderDetails['billing_country'];
        $orderPushOrderDetails['billing_email'] = $userDetail["email"] ?? " ";
        $orderPushOrderDetails['billing_phone'] = $userDetail["phone_no"] ?? " ";//billing phone number is required
        $orderPushOrderDetails['billing_pincode'] = $orderDetails['billing_zip'];
        $orderPushOrderDetails['shipping_is_billing'] = true;
        $orderPushOrderDetails['shipping_customer_name'] = $orderDetails['acceptor_user_name'];
        $orderPushOrderDetails['shipping_last_name'] = "";
        $orderPushOrderDetails['shipping_address'] = $orderDetails['shipping_address'];
        $orderPushOrderDetails['shipping_address_2'] = "";
        $orderPushOrderDetails['billing_city'] = $orderDetails["shipping_city"];
        $orderPushOrderDetails['shipping_state'] = $orderDetails['shipping_state'];
        $orderPushOrderDetails['shipping_country'] = $orderDetails['shipping_country'];
        $orderPushOrderDetails['shipping_email'] = $orderDetails['acceptor_user_email'] ?? " ";
        $orderPushOrderDetails['shipping_phone'] = $orderDetails['acceptor_user_phone_no'] ?? " ";
        $orderPushOrderDetails['shipping_pincode'] = $orderDetails['shipping_zip'];


        foreach ($orderDetails['order_items'] as $key => $item) {
            $product_detail = VendorProduct::where('id', $item['product_id'])->first();



            $orderPushOrderDetails['order_items'][$key]['name'] = $product_detail->product_title;
            $orderPushOrderDetails['order_items'][$key]['sku'] = $product_detail->sku;
            $orderPushOrderDetails['order_items'][$key]['units'] = $product_detail->product_total_stock_quantity;
            $orderPushOrderDetails["order_items"][$key]['discount'] = "";
            $orderPushOrderDetails["order_items"][$key]['selling_price'] = $item['price']; //only integer
            $orderPushOrderDetails["order_items"][$key]['hsn'] = "";



        }

        $orderPushOrderDetails['shipping_charge'] = "";
        $orderPushOrderDetails['giftwrap_charge'] = "";
        $orderPushOrderDetails['transaction_charge'] = "";
        $orderPushOrderDetails['total_discount'] = "";
        $orderPushOrderDetails['sub_total'] = 1;
        $orderPushOrderDetails['length'] = 1;
        $orderPushOrderDetails['breadth'] = 1;
        $orderPushOrderDetails['height'] = 1;
        $orderPushOrderDetails['weight'] = 1;



        $orderPushOrderDetails = json_encode($orderPushOrderDetails, true);

        $c = curl_init();

        $url = "https://apiv2.shiprocket.in/v1/external/auth/login";

        curl_setopt($c, CURLOPT_URL, $url);

        $data = json_encode([
            'email' => 'dhananjay231217@gmail.com',
            'password' => '12345678'
        ]);

        curl_setopt($c, CURLOPT_POST, 1);

        curl_setopt($c, CURLOPT_POSTFIELDS, $data);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $server_output = curl_exec($c);

        curl_close($c);

        $server_output = json_decode($server_output, true);

        $url = "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc";
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $orderPushOrderDetails);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $server_output['token'] . ''));

        $result = curl_exec($c);
        curl_close($c);

        if (isset($result['status_code']) && $result['staus_code'] == '1') {
            Order::where('id', $order_id)->update(['is_pushed' => 1]);


        }

        $result = json_decode($result);



        if ($result->order_id) {


            $orderchange = Order::find($order_id);
            $orderchange->is_shipped = 1;
            $orderchange->status = 3;
            $orderchange->shipping_company_order_id = $result->order_id;
            $orderchange->channel_order_id = $result->channel_order_id;
            $orderchange->shipment_id = $result->shipment_id;
            $orderchange->shipping_company_order_status = $result->status;
            $orderchange->shipment_company_status_code = $result->status_code;
            $orderchange->onboarding_completed_now = $result->onboarding_completed_now;
            $orderchange->awb_code = $result->awb_code;
            $orderchange->courier_company_id = $result->courier_company_id;
            $orderchange->courier_name = $result->courier_name;
            $orderchange->new_channel = $result->new_channel;

            $orderchange->save();

            return $orderchange;

        }





    }





}
