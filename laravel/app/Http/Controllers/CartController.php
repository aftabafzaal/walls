<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\Products;
use App\Cart;
use App\Attributes;
use App\CartProductAttributes;
use Illuminate\Http\Request;

class CartController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $sessionId;

    public function __construct() {
        session_start();
        $this->sessionId = session_id();
    }

    public function delete($id) {
        $row = Cart::where('id', '=', $id)->delete();
        return redirect('cart/view');
    }

    public function update(Request $request) {
        $post = $request->all();

        foreach ($post['qty'] as $id => $qty) {
            $input['quantity'] = $qty;
            $affectedRows = Cart::where('id', '=', $id)->update($input);
        }

        return redirect('cart/view');
    }

    public function updateproductprice(Request $request) {
        $get = $request->all();
        $totalPrice = $get['price'];
        $response = array();
        foreach ($get['attributes'] as $data) {
            //d($data[0]);
            $check = strpos($data[0], '_option_');
            if ($check === false) {
                continue;
            } else {
                $value = explode('_option_', $data[0]);
                //d($value);
                $totalPrice+=$value[2];
            }
        }
        $response['total_price'] = $totalPrice;
        echo json_encode($response);
        //d($get['attributes']);
    }

    public function mycart() {
        $coupon = array();
        $validDiscount = Session::get('validDiscount');
        $products = array();
        $cart = Cart::getCart($this->sessionId);
        Session::put('cart', $cart);

        $countCart = array();

        if ($validDiscount == 1) {
            $coupon = Session::get('coupon');
        }

        return view('front.cart.view', compact('cart', 'products', 'coupon', 'countCart'));
    }

    public function addsimple(Request $request) {
        $products = Cart::where("product_id", $request->product_id)
                ->where('session_id', '=', $this->sessionId)
                ->limit(1)
                ->get();

        $data = $request->all();
        if (count($products) == 0) {
            $model = new Cart();
            $model->product_id = $data['product_id'];
            $model->session_id = $this->sessionId;
            $model->totalPrice = $data['total_price'];
            $model->quantity = $data['quantity'];
            $model->save();
        } else {
            $input['quantity'] = $products[0]->quantity + 1;
            $affectedRows = Cart::where('id', '=', $products[0]->id)->update($input);
        }
        return redirect($request->return);
    }

    public function add(Request $request) {
        $data = $request->all();
        $model = new Cart();
        $model->product_id = $data['product_id'];
        $model->session_id = $this->sessionId;
        $model->totalPrice = $data['total_price'];
        $model->quantity = $data['quantity'];
        $model->save();
        $cart_id = $model->id;

        //d($request->all(),1);

        if (!empty($data['attributes'])) {
            foreach ($data['attributes'] as $key => $valueData) {

                $check = strpos($valueData[0], '_option_');

                $model = new CartProductAttributes();
                $model->cart_id = $cart_id;
                $model->attribute_id = $key;
                if ($check === false) {
                    $model->value = $valueData[0];
                } else {
                    $value = explode('_option_', $valueData[0]);
                    $model->value_id = $value[1];
                    $model->value = $value[0];
                }
                $model->save();
            }
        }
    }

}
