<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator, Input, Redirect; 

use DB;
use Auth;
use App\Shipping;

use Session;
use Illuminate\Http\Request;

class ShippingController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	 
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	
	/**
	 * All Cafe's For Admin.
	 */
	public function index()
	{
	   $model =Shipping::all();
        return view('admin.shipping.index',[
			'model' => $model,
			]);
	}

	/**
	 * Clients Cafe.
	 */
	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	 
	
	public function create()
	{	   
    	if(Auth::user()->role->role == 'admin')
        {
    	
    		$result = Shipping::lists('name', 'id');
    		return view('admin.shipping.create');
    	}
    	else{
    		return redirect('home'); 
    	}
	}
	
    /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function insert(Request $request)
	{
	  	$validator = Validator::make($request->all(), [
    		'name'     => 'required|max:255|unique:shipping',
    		'price' => 'required|numeric',
        ]);
        
        
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors());
		}
		$model = new Shipping;
		
		$model->name = $request->name;
        $model->price = $request->price;
		$model->save();
        \Session::flash('success', 'Shipping Method Added Successfully!');
		return redirect('admin/shipping');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$row = Shipping::where('id', '=', $id)->get();
       
		//print_r($row);
		//exit;
		return view('admin.shipping_view')->with('result',$row);
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//$model = Shipping::where('id', '=', $id);
        $model = Shipping::findOrFail($id);
      //  return view('admin.shipping.edit')->withTask($shipping);
		return view('admin.shipping.edit',compact('model'))->with('id',$id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
        $id = $request->id;
        
        $shipping = Shipping::findOrFail($id);
        $input = $request->all();
        
        unset($input['_token']);
        $affectedRows = Shipping::where('id', '=', $id)->update($input);
        
        \Session::flash('message', 'Updated Successfully!');
		return redirect('admin/shipping');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
	   $row = Shipping::where('id', '=', $id)->delete();
	   return redirect('admin/shipping');
	}


}
