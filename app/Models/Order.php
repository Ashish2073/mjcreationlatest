<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\VendorProduct;

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


        $orderPushOrderDetails['order_id'] = $orderDetails['id'];
        $orderPushOrderDetails['order_date'] = $orderDetails['created_at'];
        $orderPushOrderDetails['pickup_location'] = 'mjcreation';
        $orderPushOrderDetails['channel_id'] = '5101820';
        $orderPushOrderDetails['comment'] = "mjcreation order";
        $orderPushOrderDetails['payment_method'] = "cod";
        $orderPushOrderDetails['billing_customer_name'] = "Ashish Singh";
        $orderPushOrderDetails['billing_last_name'] = "";
        $orderPushOrderDetails['billing_address'] = $orderDetails['billing_address'];
        $orderPushOrderDetails['billing_address_2'] = "";
        $orderPushOrderDetails['billing_city'] = $orderDetails["billing_city"];
        $orderPushOrderDetails['billing_state'] = $orderDetails['billing_state'];
        $orderPushOrderDetails['billing_country'] = $orderDetails['billing_country'];
        $orderPushOrderDetails['billing_email'] = "as3542541@gmail.com";
        $orderPushOrderDetails['billing_phone'] = "7394949985";
        $orderPushOrderDetails['billing_pincode'] = $orderDetails['billing_zip'];
        $orderPushOrderDetails['shipping_is_billing'] = true;
        $orderPushOrderDetails['shipping_customer_name'] = "Raghv Singh";
        $orderPushOrderDetails['shipping_last_name'] = "";
        $orderPushOrderDetails['shipping_address'] = $orderDetails['shipping_address'];
        $orderPushOrderDetails['shipping_address_2'] = "";
        $orderPushOrderDetails['billing_city'] = $orderDetails["shipping_city"];
        $orderPushOrderDetails['shipping_state'] = $orderDetails['shipping_state'];
        $orderPushOrderDetails['shipping_country'] = $orderDetails['shipping_country'];
        $orderPushOrderDetails['shipping_email'] = "as3542541@gmail.com";
        $orderPushOrderDetails['shipping_phone'] = "";
        $orderPushOrderDetails['shipping_pincode'] = $orderDetails['shipping_zip'];


        foreach ($orderDetails['order_items'] as $key => $item) {
            $product_detail = VendorProduct::where('id', $item['product_id'])->first();



            $orderPushOrderDetails['order_items'][$key]['name'] = $product_detail->product_title;
            $orderPushOrderDetails['order_items'][$key]['sku'] = $product_detail->sku;
            $orderPushOrderDetails['order_items'][$key]['units'] = $product_detail->product_total_stock_quantity;
            $orderPushOrderDetails["order_items"][$key]['discount'] = "";
            $orderPushOrderDetails["order_items"][$key]['selling_price'] = "2500";
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

        if(isset($result['status_code']) && $result['staus_code']=='1'){
            Order::where('id', $order_id)->update(['is_pushed'=>1]);
            

        }

        dd($result);

























    }





}
