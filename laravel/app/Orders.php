<?php 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model {
    
    
   // public $table="orders";
	//
    
    
    public static function getOrderDetailByPk($id)
    {
        $orders=DB::table('orders as o')
            ->where('o.id','=',$id)
            //->where('opa.value','!=','')
            ->leftJoin('orders_products as op', 'o.id', '=', 'op.order_id')
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
            ->leftJoin('products as p', 'p.id', '=', 'op.product_id')
            ->leftJoin('address as a', 'o.id', '=', 'a.order_id')
            ->leftJoin('countries as c', 'c.id', '=', 'a.country')
            ->select('o.id as order_id','o.user_id as user_id','o.email as patientEmail','o.paymentStatus as paymentStatus','o.firstName as patientFirstName','o.lastName as patientLastName','o.message','o.paymentType','o.orderStatus as orderStatus','o.created_at as orderDate','o.gender as gender','o.dob as dob','u.firstName as firstName','u.lastName as lastName','u.email as email','op.quantity as quantity','op.price as price','o.grandTotal as grandTotal','p.id as product_id','p.name as product_name','p.image as image','a.address','a.address2','a.city','a.state','c.name as country','a.phone','a.zip')
            ->groupBy('op.id')
            ->get();
            $data=array();
            $i=0;
            foreach($orders as $order)
            {
               $data['id']=$id; 
               $data['user_id']=$order->user_id; 
               $data['patientName']=$order->patientFirstName.' '.$order->patientLastName;
               $data['name']=$order->firstName.' '.$order->lastName;
               $data['email']=$order->email; 
               $data['gender']=$order->gender;
               $data['dob']=$order->dob;
               $data['grandTotal']=$order->grandTotal; 
               $data['message']=$order->message;
               $data['orderDate']=$order->orderDate;
               $data['orderStatus']=$order->orderStatus;
               $data['paymentStatus']=$order->paymentStatus;
               $data['paymentType']=$order->paymentType;
               $data['address']=$order->address;
               $data['address2']=$order->address2;
               $data['city']=$order->city;
               $data['zip']=$order->zip;
               $data['state']=$order->state;
               $data['country']=$order->country;
               $data['zip']=$order->zip;
               $data['phone']=$order->phone;
               
               $data['products'][$i]['id']=$order->product_id;
               $data['products'][$i]['name']=$order->product_name;
               $data['products'][$i]['image']=$order->image;
               $data['products'][$i]['quantity']=$order->quantity;
               $data['products'][$i]['price']=$order->price;
               $i++;
            }
            $data=json_decode(json_encode($data), FALSE);
            //d($data,1);
            
       return $data;
    }
}