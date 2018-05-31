<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\LabsLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator,
    Input,
    Redirect;
use App\Functions\Functions;
use App\Products;

class ProductsController extends Controller {

    protected $layout = 'layouts.search';

    public function __construct() {
        
    }

    public function getBundleProducts(Request $request) {
        $products = Products::where('status', '=', 1)->where('type', '=', 'bundle')->orderBy('id', 'asc')->get();
        return view('front.bundle', compact('products'));
    }

}
