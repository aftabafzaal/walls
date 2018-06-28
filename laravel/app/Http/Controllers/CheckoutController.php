<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use App\Orders;
use App\Address;
use App\Countries;
use App\Shipping;
use App\OrdersProducts;
use App\OrderProductAttributes;
use App\OrdersDiscounts;
use App\PaymentPayflow;
use App\Transactions;
use Session;
use Illuminate\Http\Request;
use App\Functions\Payflow;
use App\Functions\Functions;
use Config;
use DB;

class CheckoutController extends Controller {

    public $auth;

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $shippings = Shipping::all();

        $coupon = array();
        $validDiscount = Session::get('validDiscount');

        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $address = Address::where('user_id', '=', $userId)->first();
        $countries = Countries::get();
        $states = \App\States::get();
        $cart = Session::get('cart');
        if ($validDiscount == 1) {
            $coupon = Session::get('coupon');
        }
        return view('front.checkout.index', compact('countries', 'user', 'cart', 'address', 'coupon', 'shippings', 'states'));
    }

    public function order(Request $request) {

        $currency = Config('params.currency_default');
        $validationArray = array(
            'billingFirstName' => 'required|max:255',
            'billingLastName' => 'required|max:255',
            'billingEmail' => 'required|email',
            'billingState' => 'required',
            'billingCity' => 'required',
            'billingAddress1' => 'required',
            'billingZip' => 'required',
            'billingPhone' => 'required',
          //  'shipping_id' => 'required',
            'message' => 'max:200',
        );



        if ($request->isShippingDifferent == 1) {
            $validationShippingArray = array(
                'shippingFirstName' => 'required|max:255',
                'shippingLastName' => 'required|max:255',
                
                'shippingState' => 'required',
                'shippingCity' => 'required',
                'shippingAddress1' => 'required',
                'shippingPhone' => 'required',
                'shippingZip' => 'required',
            );
            $validationArray = array_merge($validationArray, $validationShippingArray);
        }

        $validator = Validator::make($request->all(), $validationArray);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors(), 'checkout');
        }

        $coupon = array();
        $validDiscount = Session::get('validDiscount');

        DB::beginTransaction();
        try {

            $orderModel = new Orders();
            $orderModel->billingFirstName = $request->billingFirstName;
            $orderModel->billingLastName = $request->billingLastName;
            $orderModel->email = $request->billingEmail;

            $orderModel->shippingFirstName = $request->billingFirstName;
            $orderModel->shippingLastName = $request->billingLastName;
            $orderModel->message = $request->message;
            $orderModel->shipping_id = 1;

            if ($request->isShippingDifferent == 1) {
                $orderModel->shippingFirstName = $request->shippingFirstName;
                $orderModel->shippingLastName = $request->shippingLastName;
            }
            $country_id=167;
            $orderModel->user_id = Auth::user()->id;
            $shipping=array();
            //$shipping = Shipping::where('id', $request->shipping_id)->first();
            $shippingPrice=0;
            $discount = 0;
            if ($validDiscount == 1) {
                $coupon = Session::get('coupon');
                $orderModel->grandTotal = $request->grandTotal + $shippingPrice - $coupon['discount'];
                $discount = $coupon['discount'];
            } else {
               $orderModel->grandTotal = $request->grandTotal + $shippingPrice;
            }

            $orderModel->paymentType = 'cashondelivery';
            $orderModel->save();

            $order_id = $orderModel->id;
            $data['orderModel'] = $orderModel;

            if ($validDiscount == 1) {
                $discountModel = new OrdersDiscounts();
                $discountModel->order_id = $orderModel->id;
                $discountModel->customer_id = Auth::user()->id;
                $discountModel->coupon_id = $coupon['coupons']->id;
                $discountModel->discount = $coupon['discount'];
                $discountModel->save();
            }
            
            // $request->billing_country_id = 230;

            $address1 = new Address();
            $address1->country = $country_id;
            $address1->city = $request->billingCity;
            $address1->state = $request->billingState;
            $address1->address = $request->billingAddress1;
            $address1->address2 = $request->billingAddress2;
            $address1->order_id = $order_id;
            $address1->user_id = Auth::user()->id;
            $address1->zip = $request->billingZip;
            $address1->phone = $request->billingPhone;
            $address1->addressType = 'billing';
            $address1->save();


            $addressShiiping = new Address();
            $addressShiiping->addressType = 'shipping';
            if ($request->isShippingDifferent != 1) {
                $addressShiiping->country = $country_id;
                $addressShiiping->city = $request->billingCity;
                $addressShiiping->state = $request->billingState;
                $addressShiiping->address = $request->billingAddress1;
                $addressShiiping->address2 = $request->billingAddress2;
                $addressShiiping->order_id = $order_id;
                $addressShiiping->user_id = Auth::user()->id;
                $addressShiiping->zip = $request->billingZip;
                $addressShiiping->phone = $request->billingPhone;
            } else {
                $addressShiiping->country = $country_id;
                $addressShiiping->city = $request->shippingCity;
                $addressShiiping->state = $request->shippingState;
                $addressShiiping->address = $request->shippingAddress1;
                $addressShiiping->address2 = $request->shippingAddress2;
                $addressShiiping->order_id = $order_id;
                $addressShiiping->user_id = Auth::user()->id;
                $addressShiiping->zip = $request->shippingZip;
                $addressShiiping->phone = $request->shippingPhone;
            }
            $addressShiiping->save();
            $cart = Session::get('cart');

            $i = 1;
            $sum = 0;
            $quantity = 0;
            foreach ($cart as $product) {

                $opModel = new OrdersProducts();
                $opModel->product_id = $product->product_id;
                $opModel->price = $product->total_price;
                $opModel->order_id = $order_id;
                $opModel->quantity = $product->quantity;
                $opModel->save();

                $description = "";
                $sum += $product->total_price * $product->quantity;
                $quantity += $product->quantity;

                $attribute_ids = explode(',', $product->attribute_id);
                $attributes = explode(',', $product->attribute);
                $values = explode(',', $product->value);
                while (list($key, $attribute) = each($attributes) and list($vkey, $value) = each($values) and list($akey, $attribute_id) = each($attribute_ids)) {
                    $opaModel = new OrderProductAttributes();
                    $opaModel->attribute_id = $attribute_id;
                    $opaModel->attribute = $attribute;
                    $opaModel->value = $value;
                    $opaModel->orders_prodrocts_id = $opModel->id;
                    $opaModel->save();
                    $description .= $opaModel->attribute . ": " . $opaModel->value . "\n";
                }
                $i++;
            }

            if ($validDiscount == 1) {
                $d = $coupon['discount'] * -1;
            }
            self::sendOrderMail($order_id);

            DB::commit();
            return redirect('checkout/success/' . $order_id);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($validator->errors(), 'checkout');
            //return redirect('checkout/fail');
        }
    }

    public function success($id) {
        return view('front.checkout.success')->with('id', $id);
    }

    public function sendOrderMail($order_id) {
        $id = $order_id;

        $order_email = Config('params.order_email');

        try {
            $orders = Orders::getOrderDetailByPk($id);

            $addresses = Address::where('order_id', $id)->orderBy('addressType', 'shipping')
                    ->leftJoin('countries as c', 'c.id', '=', 'address.country')
                    ->leftJoin('states as s', 's.code', '=', 'address.state')
                    ->select('address.*', 'c.name as country', 's.title as state')
                    ->first();
            $data['orders'] = $orders;
            $data['addresses'] = $addresses;

            $subjectUser = view('emails.order_user.order_subject');
            $bodyUser = view('emails.order_user.order_body', $data);
            Functions::sendEmail(Auth::user()->email, $subjectUser, $bodyUser);

            $subject = view('emails.order_system.order_subject');
            $body = view('emails.order_system.order_body', $data);
          Functions::sendEmail($order_email, $subject, $body);
            return TRUE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return FALSE;
        }
    }

}
