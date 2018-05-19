<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    //
    protected $table = 'cart';

    public static function countCart($sessionId) {
        return $cart = Cart::where('type','!=','additional')->where('session_id',$sessionId)->count();
    }
}
