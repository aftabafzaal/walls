<?php 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model {
    protected $table='orders';
    
    public static function getOrderDetailByPk($id)
    {
        $orders=DB::table('orders as o')
            ->where('o.id','=',$id)
            //->where('opa.value','!=','')
            ->leftJoin('shipping as s', 's.id', '=', 'o.shipping_id')
            ->leftJoin('orders_discounts as od', 'od.order_id', '=', 'o.id')
            ->leftJoin('orders_products as op', 'o.id', '=', 'op.order_id')
            ->leftJoin('products as p', 'p.id', '=', 'op.product_id')
            ->leftJoin('order_product_attributes as opa', 'opa.orders_prodrocts_id', '=', 'op.id')
            ->leftJoin('attributes as a', 'a.id', '=', 'opa.attribute_id')
            ->select('o.id as order_id','o.user_id as user_id','o.paymentStatus as paymentStatus','o.billingFirstName','o.billingLastName','o.shippingFirstName','o.shippingLastName','o.email','o.email','o.message','o.paymentType','o.orderStatus as orderStatus','o.created_at as orderDate','op.quantity as quantity','op.price as price','o.grandTotal as grandTotal','p.id as product_id','p.name as product_name','p.image as image',DB::raw('group_concat(opa.attribute_id) as attribute_id'),'s.name as shippingMethod','s.price as shippingPrice','od.discount as discount',DB::raw('group_concat(opa.value) as value'),DB::raw('group_concat(opa.value_id) as value_id'),DB::raw('group_concat(a.name) as attribute'))
            ->groupBy('op.id')
            ->get();
            //d($orders,1);
            $data=array();
            $i=0;
            foreach($orders as $order)
            {
               $data['id']=$id; 
               $data['user_id']=$order->user_id; 
               $data['name']=$order->billingFirstName.' '.$order->billingLastName;
               $data['billingName']=$order->billingFirstName.' '.$order->billingLastName;
               $data['shippingName']=$order->shippingFirstName.' '.$order->shippingLastName;
               $data['email']=$order->email; 
               $data['grandTotal']=$order->grandTotal; 
               $data['message']=$order->message;
               $data['orderDate']=$order->orderDate;
               $data['shippingMethod']=$order->shippingMethod;
               $data['discount']=$order->discount;
               
               $data['shippingPrice']=$order->shippingPrice;
               $data['orderStatus']=$order->orderStatus;
               $data['paymentStatus']=$order->paymentStatus;
               $data['paymentType']=$order->paymentType;
               $data['products'][$i]['id']=$order->product_id;
               $data['products'][$i]['name']=$order->product_name;
               $data['products'][$i]['image']=$order->image;
               $data['products'][$i]['quantity']=$order->quantity;
               $data['products'][$i]['price']=$order->price;
               
               $data['products'][$i]['attribute_id']=$order->attribute_id;
               $data['products'][$i]['attribute']=$order->attribute;
               $data['products'][$i]['value_id']=$order->value_id;
               $data['products'][$i]['value']=$order->value;
               $i++;
            }
            $data=json_decode(json_encode($data), FALSE);
            
            
       return $data;
    }

}