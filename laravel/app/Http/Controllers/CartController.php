<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\Products;
use App\Cart;
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

    
    public function miniCart() {

        $countCart = Cart::countCart($this->sessionId);
        return view('front.cart.mini_cart',compact("countCart"));
    }
    
    
    
    
    public function update(Request $request) {
        $post = $request->all();

        foreach ($post['qty'] as $id => $qty) {

            if ($qty <= 0) {
                continue;
            }

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
                $totalPrice += $value[2];
            }
        }
        $response['total_price'] = $totalPrice;
        echo json_encode($response);
    }

    public function mycart() {

        
        $countCart = Cart::countCart($this->sessionId);
        $cart = $this->setCart();
                $coupon = array();
        Session::put('cart', $cart);
        return view('front.cart.view', compact('cart', 'products', 'coupon','countCart'));
    }
    
    public function setCart(){
         $cart = DB::table('cart as c')
                ->where('c.session_id', '=', $this->sessionId)
                ->leftJoin('products as p', 'p.id', '=', 'c.product_id')
                ->leftJoin('cart_product_attributes as cpa', 'cpa.cart_id', '=', 'c.id')
                ->leftJoin('attributes as a', 'a.id', '=', 'cpa.attribute_id')
                ->leftJoin('urls as u', 'u.type_id', '=', 'c.product_id')
                ->select('c.id as cart_id', 'c.type as productType', 'c.quantity as quantity', 'c.totalPrice as total_price', 'p.id as product_id', 'p.type as type',  'p.name as product_name', 'p.image as image', DB::raw('group_concat(cpa.attribute_id) as attribute_id'), DB::raw('group_concat(cpa.value) as value'), DB::raw('group_concat(cpa.value_id) as value_id'),'u.key as key', DB::raw('group_concat(a.name) as attribute'))
                ->groupBy('c.id')
                ->orderBy('c.id', 'asc')
                ->get();
        Session::put('cart', $cart);
        return $cart;
    }
    
    

    public function add(Request $request) {

        $data = $request->all();
        $cart = Cart::where('product_id', $data['product_id'])->where('session_id', $this->sessionId)->first();
        $product = Products::find($data['product_id']);
        
        if($product->sale==1 && $product->price>$product->salePrice){
            $price=$product->salePrice;
        }else{
            $price=$product->price;
        }
        
        if (count($cart) > 0) {
            $input['quantity'] = $cart->quantity + 1;
            $affectedRows = Cart::where('id', $cart->id)->update($input);
        } else {
            $model = new Cart();
            $model->product_id = $data['product_id'];
            $model->session_id = $this->sessionId;
            $model->totalPrice = $price;
            $model->quantity = $data['quantity'];
            $model->type = $product->type;
            $model->save();
            $cart_id = $model->id;
        }
        $this->setCart();
    }

}
