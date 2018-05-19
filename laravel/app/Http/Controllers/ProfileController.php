<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect; 

use Auth;
use App\User;
use Session;
use Illuminate\Http\Request;

class ProfileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function __construct()
	{
		$this->middleware('auth');
		
	}
	
	public function index()
	{
		if(Auth::user()->role->role != 'admin') {

			$name = Auth::user()->name;
			$email = Auth::user()->email;
			$created_at = Auth::user()->created_at;
			
			return view('admin.profile',[
				'name'=>$name,
				'email'=>$email,
				'reg_date'=>$created_at,
			]);
		}
		else{
			 return redirect('home'); 
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	 
	
	public function create()
	{
		$result = Categories::lists('image', 'id');
		return view('admin.categories_create')->with('parents', $result);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$row = Categories::where('id', '=', $id)->delete();
		return redirect('categories');
	}

}
