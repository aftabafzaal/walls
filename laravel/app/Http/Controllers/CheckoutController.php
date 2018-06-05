<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use Auth;
use App\Products;
use App\User;
use App\Orders;
use App\Address;
use Config;
use App\States;
use App\OrdersProducts;
use App\ProductsCategories;
use App\OrdersBundles;
use Session;
use Illuminate\Http\Request;
use Stripe;
use App\StripeCustomers;
use App\QuestOrders;
use App\Quest\Api;
use App\Content;
use App\Cart;
use App\Functions\Functions;

//use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CheckoutController extends Controller {

    public $auth;
    private $sessionId;

    public function __construct() {

        $this->middleware('auth');
        session_start();
        $this->sessionId = session_id();
        //$this->paypal = new PayPal();
        // $this->_apiContext = $this->paypal->ApiContext(
        //        config('paypal.express.client_id'), config('paypal.express.secret'));
        // $this->_apiContext->setConfig(config('paypal.express.config'));
    }

    public function index() {
        //$shippings = Shipping::all();

        $coupon = array();
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);
        $address = Address::where('user_id', '=', $userId)->first();
        $states = States::lists('title', 'code');

        if (empty($address)) {
            $address = new Address();
            $address->address = null;
            $address->address2 = null;
            $address->state = null;
            $address->city = null;
            $address->zip = null;
            $address->phone = null;
        }

        $cart = Session::get('cart');
        $countCart = Cart::countCart($this->sessionId);
        if ($countCart == 0) {
            return redirect("/");
        }

        return view('front.checkout.index', compact('states', 'user', 'cart', 'address'));
    }

    public function order(Request $request) {
        //error_reporting(1);
        $userId = Auth::user()->id;
        $validationArray = array(
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30',
            'email' => 'email|required|max:100',
            'country_id' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address1' => 'required',
            'zip' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'terms' => 'required',
            'ssn' => 'max:15',
            'cc' => 'required|max:16',
            'cvc' => 'required|max:4',
            'message' => 'min:10|max:300',
        );

        // d($request->all(),1);
        //$token = $request->stripeToken;

        $user = User::findOrFail($userId);
        $email = $user->email;
        $validator = Validator::make($request->all(), $validationArray);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors(), 'checkout');
        }
        $orderPrefix = Config::get('params.order_prefix');
        $stripe = Stripe::setApiKey(env('STRIPE_SECRET_SK'));

        try {

            $token = $stripe->tokens()->create([
                'card' => [
                    'number' => $request->cc,
                    'exp_month' => $request->expMonth,
                    'exp_year' => $request->expYear,
                    'cvc' => $request->cvc,
                ],
            ]);

            $stripeCustomerModel = StripeCustomers::where('user_id', $userId)->orderBy('id', 'desc')->first();
            if (isset($stripeCustomerModel->stripeCustomerId)) {
                $stripeCustomerId = $stripeCustomerModel->stripeCustomerId;
                $customer = Stripe::customers()->update($stripeCustomerId, array('source' => $token['id']));
            } else {
                $customer = Stripe::customers()->create([
                    'source' => $token['id'],
                    'email' => $email,
                    'metadata' => [
                        "First Name" => $user->firstName,
                        "Last Name" => $user->lastName
                ]]);

                $stripeCustomerId = $customer['id'];
                $insert_id = StripeCustomers::insertGetId(array('user_id' => $userId, 'stripeCustomerId' => $stripeCustomerId));

                $defaultSource = $customer['default_source'];
            }

            $defaultSource = $customer['default_source'];
        } catch (\Stripe\Error\Card $e) {
            return redirect()->back()->withErrors($e->getMessage(), 'checkout')->withInput();
        }

        DB::beginTransaction();

        try {

            $orderModel = new Orders();
            $orderModel->firstName = $request->firstName;
            $orderModel->lastName = $request->lastName;
            $orderModel->dob = $request->year . "-" . $request->month . "-" . $request->date;
            $orderModel->gender = $request->gender;
            $orderModel->email = $request->email;
            $orderModel->message = $request->message;
            $orderModel->user_id = Auth::user()->id;
            $orderModel->grandTotal = $request->grandTotal;
            $orderModel->paymentType = 'stripe';
            $orderModel->save();
            $order_id = $orderModel->id;
            $address1 = new Address();
            $address1->country = $request->country_id;
            $address1->city = $request->city;
            $address1->state = $request->state;
            $address1->address = $request->address1;
            $address1->address2 = $request->address2;
            $address1->order_id = $order_id;
            $address1->user_id = Auth::user()->id;
            $address1->zip = $request->zip;
            $address1->phone = $request->phone;
            $address1->addressType = 'patient';
            $address1->save();

            $quest['PATIENT_LASTNAME'] = $request->lastName;
            $quest['PATIENT_FIRSTNAME'] = $request->firstName;
            $quest['PID'] = 'P' . $order_id;
            $quest['DOB'] = $request->year . sprintf("%02d", $request->month) . sprintf("%02d", $request->date);
            $quest['GENDER'] = strtoupper($request->gender);
            $quest['PHONE'] = strtoupper($request->phone);
            $quest['SSN'] = $request->ssn;
            $quest['MESSAGE_CODE'] = 'ORM^O01';
            $quest['MESSAGE_CONTROL_ID'] = $orderPrefix . $order_id;

            $quest['ORDER_CONTROL'] = 'NW';
            $quest['ORDER_NUMBER'] = $order_id;
            $cart = Session::get('cart');

            $charge = Stripe::charges()->create([
                'amount' => $request->grandTotal,
                'currency' => 'usd',
                'customer' => $stripeCustomerId,
                'source' => $defaultSource,
                'metadata' => [
                    "Order ID" => $orderPrefix . $order_id,
                    "Link" => url('admin/order/' . $order_id)
                ],
                'capture' => true]);


            $sum = 0;
            $quantity = 0;
            $tests = array();
            $testCount = 1;
            $i = 1;
            foreach ($cart as $product) {

                $opModel = new OrdersProducts();
                $opModel->product_id = $product->product_id;
                $opModel->price = $product->total_price;
                $opModel->order_id = $order_id;
                $opModel->quantity = $product->quantity;
                $opModel->save();

                $productModel = Products::find($product->product_id);

                if ($productModel->type == 'bundle') {

                    $productCategories = ProductsCategories::getBundleCategories($productModel->id);
                    // d($productCategories,1);
                    foreach ($productCategories as $pc) {
                        $input['name'] = $productModel->name . '-' . $pc->category . '-' . $pc->name;
                        $input['product_id'] = $productModel->id;
                        $input['order_id'] = $order_id;
                        $input['created_at'] = date('Y-m-d H:i:s');
                        $id = OrdersBundles::insertGetId($input);
                        $tests[$testCount++] = 'ORC|NW|' . $order_id . '|||||||||||';
                        $tests[$testCount++] = 'OBR|' . $i . '|' . $order_id . '||^^^B' . $productModel->id . '^' . $input['name'] . '|||{{TIME}}|||||||||||||||||||||';
                    }
                } elseif ($productModel->type == 'simple') {

                    $tests[$testCount++] = 'ORC|NW|' . $order_id . '|||||||||||';
                    $tests[$testCount++] = 'OBR|' . $i . '|' . $order_id . '||^^^' . $productModel->sku . '^' . $productModel->name . '|||{{TIME}}|||||||||||||||||||||';

                    $testCount++;
                    $i++;
                }
            }
            $quest['TESTS'] = implode("\r", $tests);

            //if ($order_id > 350) {
            //    return redirect('checkout/fail');
            //}

            $questOrder = Api::submitOrder($quest, $order_id);
            $questOrder = base64_decode($questOrder);
            QuestOrders::insertGetId(array('order_id' => $order_id, 'response' => $questOrder));
            Session::put('order_id', $order_id);
            DB::commit();
            return redirect('checkout/success/' . $order_id);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('checkout/fail');
        }
    }

    public function success($id) {

        $order = Orders::getOrderDetailByPk($id);
        $orderPrefix = Config::get('params.order_prefix');
        //d($order,1);
        $content = Content::where('code', '=', 'order_confirmation')->get();
        $replaces = array();
        $template = Functions::setEmailTemplate($content, $replaces);
        $message = 'You have received an order from ' . $order->patientName . '. Their order is as follows:';
        $link = url('') . '/admin/order/' . $id;
        $body = view('front.orders.email', compact('order', 'message', 'link'))->with('id', $id);
        $mail = Functions::sendEmail(Config::get('params.from_email'), $template['subject'], $body);
        $message = '';
        $link = url('') . '/order/' . $id;
        $body = view('front.orders.email', compact('order', 'message', 'link'))->with('id', $id);
        // $mail = Functions::sendEmail($order->email, $template['subject'], $body);
        Cart::where('session_id', '=', $this->sessionId)->delete();
        return view('front.checkout.success')->with('id', $id);
    }

    public function fail() {
        return view('front.checkout.fail');
    }

}
