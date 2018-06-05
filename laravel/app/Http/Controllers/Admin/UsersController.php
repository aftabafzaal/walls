<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Orders;

class UsersController extends AdminController {

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
                    ->paginate(20);
            return view('admin.clients', compact('model'));
        } else {
            return redirect('home');
        }
    }

    public function userDetail($id) {
        $userId = $id;
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
    
    public function makemanager($id) {
        $row = User::where('id', '=', $id)->update(array("role_id"=>3));
        return redirect('admin/user/'.$id);
    }
    
    public function removemanager($id) {
        $row = User::where('id', '=', $id)->update(array("role_id"=>2));
        return redirect('admin/user/'.$id);
    }

}
