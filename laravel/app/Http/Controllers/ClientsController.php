<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Orders;

class ClientsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if (Auth::user()->role->role == 'admin') {

            $model = User::where('role_id', '!=', 1)
                    ->leftJoin('roles as r', 'r.id', '=', 'users.role_id')
                    ->select('users.id', 'users.firstName', 'users.lastName', 'users.email', 'users.role_id', 'users.created_at', 'r.role')
                    ->get();
            return view('admin.clients', compact('model'));
        } else {
            return redirect('home');
        }
    }

    public function userDetail(Request $request) {
        $userId = $request->id;
        if ($userId > 0) {
            if (Auth::user()->role->role == 'admin') {

                $result = User::leftJoin('address', 'address.user_id', '=', 'users.id')
                                ->select('users.*', 'address.phone', 'address.country', 'address.state', 'address.city', 'address.address', 'address.zip', 'address.created_at'
                                        , 'address.addressType', 'address.address2', 'address.mobile')
                                ->where('users.id', '=', $userId)
                                ->whereNull('address.order_id')->get();

                $orders = Orders::where('orders.user_id', '=', $userId)
                        ->orderBy('orders.id', 'desc')
                        ->get();

                // d($result);
                // d($orders,1);

                return view('admin.client', [
                    'data' => $result,
                    'orders' => $orders,
                ]);
            } else {
                return redirect('home');
            }
        } else {
            return redirect('home');
        }
    }

}
