<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Orders;
use App\OrderProductAttributes;
use App\OrdersProducts;
use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\OrdersResults;

class OrdersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function order($id) {
        $order = Orders::getOrderDetailByPk($id);
        $results = OrdersResults::where('order_id', $id)->orderBy('created_at', 'desc')->get();
        return view('front.orders.order', compact('order','results'));
    }

    public function myorders() {
        $user_id = Auth::user()->id;
        $orders = Orders::where('user_id', $user_id)->orderBy('id')->get();

        return view('front.orders.index', compact('orders'));
    }

}
