<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use DB;
use App\User;
use App\Orders;
use App\Products;
use Auth;
use Session;
use Illuminate\Http\Request;

class HomeController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // modified hassan join paypal and orders table that each order must be in papal table 
        $users = User::get();
        $totalUsers = $users->count();

        $orders = Orders::where('deleted', 0)->where('paymentStatus', 'success')->get();
        $totalSuccessSales = $orders->count();

        $ordersPending = Orders::where('deleted', 0)->where('paymentStatus', 'pending')->get();
        $totalPendingSales = $ordersPending->count();

        $ordersTotal = Orders::where('deleted', 0)->get();
        $totalSales = $ordersTotal->count();
        $recentOrders = Orders::where('deleted', 0)->orderBy('orders.id', 'desc')->take(10)->get();
        $products = Products::whereNotNull('image')->take(10)->orderBy('id', 'desc')->get();

        return view('admin.home', [
            'totalUsers' => $totalUsers,
            'totalSuccessSales' => $totalSuccessSales,
            'totalPendingSales' => $totalPendingSales,
            'totalSales' => $totalSales,
            'recentOrders' => $recentOrders,
            'products' => $products,
        ]);
    }

}
