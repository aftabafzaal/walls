<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect; 
use App\Contactus;

use Session;
use Illuminate\Http\Request;
class ContactusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function __construct()
	{
		
	}

	// Contact-us
	public function contact()
	{
		
		return view('front.contactus');
	}
	
	public function store(Request $request)
	{
		
		
		$validation = array('name' => 'required|max:30',
			'email' => 'required|email|max:30',
			'captcha' => 'required|captcha',
            'message' => 'required|min:6|max:200');
			
		 $messages = [
            'captcha' => 'The :attribute field is invalid.',
        ];
		// $array = $validation;
		
		$validator = Validator::make($request->all(),$validation, $messages);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors())->withInput();
		}
		
		$contactus = new Contactus;
		$contactus->name = $request->name;
		$contactus->email = $request->email;
		$contactus->message = $request->message;
		$contactus->save();
		///d($contactus);die;
        return redirect('contact-us')->withInput();
        
	}
	
	
	

	
	
}
