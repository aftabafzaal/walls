<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\User;
use App\Countries;
use App\States;
use App\Address;
use Auth;
use Hash;
use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class CustomersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    use AuthenticatesAndRegistersUsers;

    public function __construct() {
        $this->middleware('auth');
    }

    public function changepassword() {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        //die('sadasd');	   
        return view('front.customers.change_password')->with('user_id', $user_id);
    }

    public function postchangepassword(Request $request) {
        $user_id = Auth::user()->id;
        $rules = array(
            'old_password' => 'required|min:6',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|min:6',
        );
//'password'              => 'min:5|confirmed|different:now_password',
//'password_confirmation' => 'required_with:password|min:5'

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            //d($request->all(),1);
            return redirect('changepassword')->withErrors($validator->errors());
            //return redirect('changepassword')->withInput();
        }

        $user = User::findOrFail($user_id);

        //if(bcrypt($request->old_password) == $user->password)
        //{
        $data = $request->all();
        array_forget($data, 'password_confirmation');
        array_forget($data, 'old_password');
        array_forget($data, '_token');
        $data['password'] = bcrypt($request->password);

        $user->update($data);
        Session::flash('success', 'Your password has been changed.');
        return redirect()->back();
        //}


        Session::flash('error', 'Old password is Incorrect.');
        return redirect()->back()->withError('Incorrect old password', 'changepassword');
    }

    public function profile() {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        if (isset($user->dob)) {
            list($year, $month, $date) = explode('-', $user->dob);
            $user->day = $date;
            $user->month = $month;
            $user->year = $year;
        }
        $states = States::get();


        $address = Address::where('user_id', '=', $user_id)->first();
        if (empty($address)) {
            $address = new Address();
        }

        $countries = Countries::lists('name', 'id');
        return view('front.customers.profile', compact('user', 'states', 'countries', 'address'))->with('user_id', $user_id);
    }

    public function updateprofile(Request $request) {

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $rules = array(
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|min:6|email|unique:users,email,' . $user->id,
            'city' => 'required|min:2',
            'address' => 'required|min:10',
            'zip' => 'required|min:4',
            'phone' => 'required|min:10',
        );

        $validator = Validator::make($request->all(), $rules);

        // $checkEmail=User::where('email','!=',$user->email)->where('email',$request->email)->count();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator, 'register')->withInput();
        } else {
            $user = User::findOrFail($user_id);

            $data = $request->all();
            $input['gender'] = $request->gender;
            $input['firstName'] = $request->firstName;
            $input['lastName'] = $request->lastName;
            $input['dob'] = $request->year . "-" . $request->month . "-" . $request->date;
            array_forget($data, '_token');
            $address['state'] = $request->state;
            $address['city'] = $request->city;
            $address['country'] = $request->country;
            $address['address'] = $request->address;
            $address['zip'] = $request->zip;

            $affectedRows = User::where('id', '=', $user_id)->update($input);
            if ($request->address_id!="") {
                $affectedRows = Address::where('id', '=', $request->address_id)->update($address);
            } else {
                $address = new Address;
                $address->user_id = $user->id;
                $address->phone = $request->phone;
                $address->country = 230;
                $address->state = $request->state;
                $address->city = $request->city;
                $address->address = $request->address;
                $address->zip = $request->zip;
                $address->save();
            }
            Session::flash('success', 'Your profile has been updated.');
            return redirect()->back();
        }
    }

}
