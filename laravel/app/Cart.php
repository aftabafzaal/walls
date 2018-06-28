<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cart extends Model {

    //
    protected $table = 'cart';

    public static function countCart($sessionId) {
        return $cart = Cart::where('session_id', $sessionId)->count();
    }

    public static function getCart($sessionId) {
        return $cart = DB::table('cart as c')
                ->where('c.session_id', '=', $sessionId)
                ->leftJoin('products as p', 'p.id', '=', 'c.product_id')
                ->leftJoin('cart_product_attributes as cpa', 'cpa.cart_id', '=', 'c.id')
                ->leftJoin('attributes as a', 'a.id', '=', 'cpa.attribute_id')
                ->select('c.id as cart_id', 'c.quantity as quantity', 'c.totalPrice as total_price', 'p.id as product_id', 'p.name as product_name', 'p.image as image', DB::raw('group_concat(cpa.attribute_id) as attribute_id'), DB::raw('group_concat(cpa.value) as value'), DB::raw('group_concat(cpa.value_id) as value_id'), DB::raw('group_concat(a.name) as attribute'))
                ->groupBy('c.id')
                ->orderBy('c.id', 'desc')
                ->get();
    }

}