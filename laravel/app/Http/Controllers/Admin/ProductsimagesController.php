<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator, Input, Redirect; 

use DB;
use Auth;
use App\Categories;
use App\Attributes;
use App\Products;
use App\ProductsImages;
use App\Attributesvalues;

use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class ProductsimagesController extends AdminController {

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
	   $categories =Categories::all();
        return view('admin.categories.index',[
			'categories' => $categories,
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
    	
    		$result = Categories::lists('name', 'id');
    		return view('admin.categories.create');
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
    		'image'     => 'required|mimes:jpeg,bmp,png,gif',
    	]);
        
        if ($validator->fails()) {
		  return redirect()->back()->withErrors($validator->errors());
		}
		$model = new ProductsImages;
				
        if (Input::hasFile('image'))
        {
           $file = Input::file('image');
           $destinationPath=public_path().'/uploads/products_images/';
           $destinationPathThumb=$destinationPath.'thumbnail/';
           
           $extension = $file->getClientOriginalExtension();
           $fileName = rand(111,999).time().'.'.$extension;
           $image = $destinationPath . '/' .$fileName;
           $upload_success=  $file->move($destinationPath,$fileName);
           $upload = Image::make($image)->resize(150,150)->save($destinationPathThumb.$fileName);
           $model->image = $fileName;
        }
                
        $model->attribute_value_id = $request->attribute_value_id;
        $model->product_id = $request->product_id;
        
        $model->save();
        \Session::flash('success', 'Product Image Added Successfully!');
        return redirect('admin/productsimages/manage/'.$model->product_id);
	}
    
    public function manage($product_id)
	{
	   
        $model = DB::table('products_images as p')
        ->where('product_id', '=', $product_id)
        ->leftJoin('attributes_values as av', 'av.id','=', 'p.attribute_value_id')
        ->select('p.id as id','p.caption as caption','p.image as image','av.name as name','p.attribute_value_id as attribute_value_id')
        ->get();
        $attValuesIds=array();
        foreach($model as $val){
            $attValuesIds[]=$val->attribute_value_id;
        }
        $product = Products::findOrFail($product_id);
        $color=Attributes::where("code","=","color")->limit(1)->get();
        $colors=Attributesvalues::where("attribute_id","=",$color[0]->id)
        ->whereNotIn('id',$attValuesIds)
        ->lists('name', 'id');
        return view('admin.products_images.manage',compact('product','model','colors','color'))->with('product_id',$product_id);
	}

	public function delete($id,$product_id)
	{
	   $row = ProductsImages::where('id', '=',$id)->delete();
       return redirect('admin/productsimages/manage/'.$product_id);
	}
}
