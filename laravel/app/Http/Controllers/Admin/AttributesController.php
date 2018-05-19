<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator, Input, Redirect; 

use DB;
use Auth;
use App\Attributes;
use App\Attributesvalues;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class AttributesController extends AdminController {

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
	   $attributes =Attributes::all();
        return view('admin.attributes.index',[
			'attributes' => $attributes,
			]);
	}




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	 
	
	public function create()
	{	   
    	if(Auth::user()->role->role == 'admin')
        {
    	
    		$result = Attributes::lists('name', 'id');
    		return view('admin.attributes.create');
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
    		'name'     => 'required|max:255|unique:attributes',
            'code'     => 'required|max:255|unique:attributes',
        ]);
        if ($validator->fails()) {
    		return redirect()->back()->withErrors($validator->errors());
    	}
    	
        $model = new Attributes;
    	$model->name = $request->name;
        $model->code = $request->code;
        $model->type = $request->type;
        $model->save();
        \Session::flash('success', 'Attribute Added Successfully!');
    	return redirect('admin/attributes');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{	
		$row = Attributes::where('id', '=', $id)->get();
		return view('admin.attributes_view')->with('result',$row);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//$model = Attributes::where('id', '=', $id);
        $attribute = Attributes::findOrFail($id);
      //  return view('admin.Attributes.edit')->withTask($attribute);
		return view('admin.attributes.edit',compact('attribute'))->with('id',$id);
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
        
        $attribute = Attributes::findOrFail($id);
        
        
        $input = $request->all();
        
        unset($input['_token']);
        $affectedRows = Attributes::where('id', '=', $id)->update($input);
        
        \Session::flash('message', 'Updated Successfully!');
		return redirect('admin/attributes');
	}
    
    public function values($id)
	{
        $attribute = Attributes::findOrFail($id);
        $attributeValues = Attributesvalues::getAttributesValues($id);
        return view('admin.attributes.values',compact('attribute','attributeValues','id'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
	   $row = Attributes::where('id', '=', $id)->delete();
	   return redirect('admin/attributes');
	}

}