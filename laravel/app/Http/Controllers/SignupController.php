<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\User;
use App\States;
use App\Address;
use App\Content;
use App\Products;
use App\Role;
use App\Cart;
use App\Functions\Functions;
use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\RedirectResponse;

class SignupController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $loginPath = 'signup';

    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index() {
        return view('front.customers.login_customer');
    }

    public function doctors_login() {
        return view('front.customers.login_doctors');
    }

    public function register() {
        $result = States::get();
        return view('front.customers.register')->with('states', $result);
    }

    public function register_doctor() {
        $result = States::get();
        return view('front.customers.register_doctor')->with('states', $result);
    }

    public function forgot_password() {
        return view('front.customers.forgot');
    }

    public function reset_password(Request $request) {
        $validation = array(
            'email' => 'required|email',
        );

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {

            return redirect('forgot')->withErrors($validator->errors());
        }

        $user = User::where("email", "=", $request->email)->get();
        if (count($user) == 1) {
            $password = substr(md5(microtime()), rand(0, 26), 7);
            $user = $user[0];
            $replaces['NAME'] = $user->firstName . ' ' . $user->lastName;
            $replaces['PASSWORD'] = $password;
            $affectedRows = User::where('id', '=', $user->id)->update(array('password' => bcrypt($password)));
            $content = Content::where('code', '=', 'forgot_password')->get();
            $template = Functions::setEmailTemplate($content, $replaces);
            $mail = Functions::sendEmail($request->email, $template['subject'], $template['body']);
            \Session::flash('success', 'Your new password has been emailed.');
        } else {
            \Session::flash('success', 'Email not found.');
        }

        return redirect('forgot');
    }

    public function postLogin(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            /*
              session_start();

              $cart = Cart::countCart(session_id());
              if ($cart > 0) {
              $cart = Cart::where('session_id', '=', session_id())->where('type', '=', 'simple')->get();
              foreach ($cart as $product) {
              $model = Products::find($product->product_id);
              $price = Functions::getPrice(Auth::user(), $model);
              Cart::where('id', $product->id)->update(array('totalPrice' => $price));
              }

              //d($cart,1);
              // return redirect('cart/view');
              // die;
              } */


            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            'email' => $this->getFailedLoginMessage(),
        ]);
    }

    public function store(Request $request) {

        $validation = array(
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:20',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:6',
            'gender' => 'required',
            'state' => 'required',
            'date' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'city' => 'required|max:25',
            'zip' => 'required|max:15',
            'address' => 'required|max:200',
            'phone' => 'required|max:16',
            'g-recaptcha-response' => 'required|recaptcha',
        );

        $messages = [
            "recaptcha" => 'The :attribute field is not correct.',
        ];
        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors(), 'register');
        }

        //d($request->all());

        $user = new User;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->state = $request->state;
        $user->gender = $request->gender;
        $user->dob = $request->year . "-" . $request->month . "-" . $request->date;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->password);
        $user->token = bcrypt($request->email . $request->password);
        $user->save();

        // d($user,1);

        $address = new Address;
        $address->user_id = $user->id;
        $address->phone = $request->phone;
        $address->country = 230;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->zip = $request->zip;
        $address->save();
        $credentials = $request->only('email', 'password');


        if ($user->id) {
            $content = Content::where('code', '=', 'registration')->get();
            $replaces['NAME'] = $user->firstName . ' ' . $user->lastName;
            $replaces['LINK'] = url('verification?token=' . $user->token);
            $template = Functions::setEmailTemplate($content, $replaces);
            $mail = Functions::sendEmail($request->email, $template['subject'], $template['body']);
        }

        if (Auth::attempt($credentials, 1)) {

            session_start();
            $cart = Cart::where('session_id', '=', session_id())->count();

            //if ($cart > 0 || empty($cart)) {
            //    return redirect('checkout');
            //    die;
            //}
            return redirect('success/' . $user->id);
        }
    }

    public function success($id) {
        return view('front.success');
    }

    public function destroy($id) {
        $row = Categories::where('id', '=', $id)->delete();
        return redirect('categories');
    }

}
