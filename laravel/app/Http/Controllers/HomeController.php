<?php

namespace App\Http\Controllers;

use DB;
use App\Categories;
use App\Products;
use App\ProductsCategories;
use App\Content;
use App\States;
use Illuminate\Http\Request;
use App\Functions\Functions;
use App\User;

class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    protected $categories = array();
    protected $layout = 'layouts.search';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->categories = 1;
    }

    public function index() {

        if (isset($_GET['test'])) {
            $body = "test body";
            echo Functions::sendEmail('aftab.golpik@gmail.com', 'test', $body);
            die;
        }
                $model = Content::where('code', 'home')->first();
        $model->body = Functions::setTemplate($model->body, array());
        $data=array();
        $data['model']=$model;
        return view('front.index',$data );
    }

    public function howtoorder() {

        $model = Content::where('code', 'how_to_order')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function faq() {
        $model = Content::where('code', 'faq')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function aboutus() {
        $model = Content::where('code', 'aboutus')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function privacy() {
        $model = Content::where('code', 'privacy')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function terms() {
        $model = Content::where('code', 'terms')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function contacts() {
        $model = Content::where('code', 'contacts')->first();
        $model->body = Functions::setTemplate($model->body, array());
        return view('front.page', compact('model'));
    }

    public function locations(Request $request) {

        $search['zip'] = $request->input('zip');
        $search['city'] = $request->input('city');
        $search['state'] = $request->input('state');
        $search['search'] = $request->input('search');
        $states = States::lists('code', 'code')->prepend('Select State', "");

        $locations = array();
        $subSql = "";
        $sqlSelect = "";
        $tableName = "labs_locations";
        $dist = 9;
        $orderSql = "";
        if ($search['search'] == 1) {

            if ($search['city'] != '') {
                $subSql .= " and city  like '" . $search['city'] . "%' ";
            }

            if ($search['zip'] != '' && is_numeric($search['zip']) && strlen($search['zip']) == 5) {

                $url = "http://maps.googleapis.com/maps/api/geocode/json?address=USA&components=postal_code:" . $search['zip'] . "&sensor=false";
                $response = Functions::makeCurlRequest($url);
                $response = json_decode($response);
                if ($response->status == 'OK') {

                    if ($search['state'] == "") {
                        $search['state'] = $response->results['0']->address_components[3]->short_name;
                    }


                    $lng = $response->results['0']->geometry->location->lng;
                    $lat = $response->results['0']->geometry->location->lat;
                    $origLat = $lat;
                    //echo "----";
                    $origLon = $lng;
                    $sqlSelect .= ",longitude, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2) +COS($origLat*pi()/180 )*COS(latitude*pi()/180)*POWER(SIN(($origLon-longitude)*pi()/180/2),2))) as distance";
                    $subSql .= " and longitude between ($origLon-$dist/cos(radians($origLat))*69) and ($origLon+$dist/cos(radians($origLat))*69) and latitude between ($origLat-($dist/69)) and ($origLat+($dist/69))";
                    $orderSql = " order by distance asc";
                }
            }

            if ($search['state'] != "") {
                $subSql .= " and state =  '" . $search['state'] . "' ";
            }


            $sql = "SELECT id,name,address,city,state,zip,zipCode,address2,longitude,latitude,phone " . $sqlSelect . " FROM $tableName where (longitude<>0 and latitude!=0) " . $subSql . $orderSql;
            $locations = DB::select($sql);
        }
        return view('front.locations.locations', compact('locations', 'states', 'search'));
    }

    public function location($id, Request $request) {
        $search['zip'] = $request->input('zip');
        $search['city'] = $request->input('city');
        $search['state'] = $request->input('state');
        $location = LabsLocations::find($id);
        return view('front.locations.location', compact('location', 'search'));
    }

    public function search(Request $request) {
        $search = $request->input('q');

        $sql = "select p.id,p.name,p.price,p.image,p.sale as sale,p.salePrice as salePrice  from products p join categories c on c.id=p.category_id 
        where p.name like '%$search%' || p.description like '%$search%' || p.keywords like '%$search%' || c.name like '%$search%';";
        $products = DB::select($sql);

        return view('front.search', compact('products'));
    }

    public function messagePost(Request $request) {
        $validation = array('name' => 'required|max:30',
            'email' => 'required|email|max:30',
            'captcha' => 'required|captcha',
            'message' => 'required|min:6|max:200');

        $messages = [
            'captcha' => 'The :attribute field is invalid.',
        ];
        // $array = $validation;

        $validator = Validator::make($request->all(), $validation, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $guestbook = new Guestbook;
        $guestbook->name = $request->name;
        $guestbook->email = $request->email;
        $guestbook->message = $request->message;
        $guestbook->save();
        return redirect('guestbook')->withInput();
    }

    public function getproduct($key) {

        if (is_numeric($key)) {
            $product = Products::find($key);
        } else {
            $search['key'] = $key;
            $model = Products::getProducts($search);
            $product = $model[0];
        }

        $id = $product->id;
        return view('front.product', compact('product'))->with('id', $id);
    }

    public function sale() {
        $category = "";
        $products = Products::where('sale', '=', 1)->where('price', '>', 'salePrice')->get();
        return view('front.products', compact('products', 'category'));
    }

    public function products($id = "all") {

        $search['type']='simple';
        $products = Products::getProducts($search);
        return view('front.products', compact('products'));
    }

    public function bundle() {
        $model = Products::where('status', '=', 1)->where('type', '=', 'bundle')->orderBy('id', 'asc')->get();

        $allCategories = Categories::orderBy('sortOrder', 'asc')->get();
        $categories = Functions::getCategories($allCategories);

        $modelProductsCategories = ProductsCategories::getBundleCategories();

        foreach ($modelProductsCategories as $pc) {
            $productCategories[$pc->id][] = $pc->category_id;
        }
        return view('front.bundle', compact('model', 'categories', 'productCategories'));
    }

    public function verification() {
        $token = $_GET['token'];
        $user = User::where("token", "=", $token)->first();

        if (count($user) == 1) {
            $user = User::where("id", "=", $user->id)->update(array('isVerified' => 1));
            $verification = 'verify_success';
        } else {
            $verification = 'verify_fail';
        }

        $model = Content::where('code', '=', $verification)->first();
        return view('front.customers.verification', compact('verification', 'model'));
    }

}
