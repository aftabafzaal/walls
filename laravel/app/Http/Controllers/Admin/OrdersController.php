<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\AdminController;
use DB;
use App\Address;
use App\Orders;
use App\OrdersResults;
use App\Content;
use Config;
use App\Functions\Functions;
use Auth;
use App\StripeCustomers;
use App\QuestOrders;
use App\OrdersDocuments;

class OrdersController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function order($id) {

        $orders = Orders::getOrderDetailByPk($id);

        $addresses = Address::where('order_id', $id)->orderBy('addressType', 'asc')->groupBy('addressType')->limit(2)
                ->leftJoin('countries as c', 'c.id', '=', 'address.id')
                ->select('address.*', 'c.name as country')
                ->get();



        $questOrder = QuestOrders::where('order_id', $id)->first();
        $ordersDocuments = OrdersDocuments::where('order_id', $id)->first();
        $results = OrdersResults::where('order_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.orders.order', [
            'orders' => $orders,
            'addresses' => $addresses,
            'results' => $results,
            'quest' => $questOrder,
            'ordersDocuments' => $ordersDocuments,
        ]);
    }

    public function index() {
        $orders = Orders::where('deleted',0)->orderBy('orders.id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function order_status(Request $request) {
        $_token = $request->input('_token');
        $status = $request->input('status');
        if (csrf_token() == $_token) {

            if ($status == 'all') {
                $orders = Orders::orderBy('orders.id', 'desc')->get();
            } else {
                $orders = Orders::orderBy('orders.id', 'desc')->where('orderStatus', "=", $status)->get();
            }
            echo json_encode($orders);
        } else {
            echo json_encode('0');
        }
    }

    public function update_order_status(Request $request) {
        $_token = $request->input('_token');
        $order = $request->input('orderid');
        $status = $request->input('status');
        $response = array();
        if (csrf_token() == $_token) {
            if (Orders::where('id', $order)->update(['orderStatus' => $status])) {
                //$content = Content::where('code', '=', 'order_status')->get();
                //$orders = Orders::getOrderDetailByPk($order);
                //$replaces['NAME'] = $orders->billingName;
                //$replaces['STATUS'] = $orders->orderStatus;
                //$orderPrefix = Config::get('params.order_prefix');
                //$replaces['ID'] = $orderPrefix . $orders->id;
                //$replaces['ACCOUNT'] = '<a href="' . url('order/' . $order) . '" >My Account</a>';
                //$template = Functions::setEmailTemplate($content, $replaces);
                //$mail = Functions::sendEmail($orders->email, $template['subject'], $template['body']);
                $response['success'] = 1;
            } else {
                $response['success'] = 0;
            }
        } else {
            $response['success'] = 0;
        }
        echo json_encode($response);
    }
    
    public function delete($id) {
        Orders::where('id', $id)->update(['deleted' => 1]);
        return redirect('admin/orders');
        //OrderResults::where('order_id', $id)->update(['deleted' => 1]);
    }
    
}
