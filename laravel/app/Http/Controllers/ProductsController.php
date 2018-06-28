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
        $products = Products::where('status', '=', 1)->where('type', '=', 'bundle')->orderBy('id', 'desc')->get();
        return view('front.bundle', compact('products'));
    }
    
    
    public function getFeaturedProducts(Request $request) {
        $products = Products::where('status', '=', 1)->where('type', '=', 'simple')->where('featured', '=', '1')->orderBy('id', 'desc')->get();
        return view('front.featured', compact('products'));
    }
    
    public function getPopularProducts(Request $request) {
        $products = Products::where('status', '=', 1)->where('type', '=', 'simple')->where('popular', '=', '1')->orderBy('id', 'desc')->get();
        return view('front.popular', compact('products'));
    }

}
