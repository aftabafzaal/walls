<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Categories;
use App\ProductsCategories;
use App\Products;
use App\Functions\Functions;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator,
    Input,
    Redirect;
use Intervention\Image\Facades\Image as Image;
use App\Urls;

class ProductsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = 'simple';
        }
        
        $search=$_GET;
        // $search['title']="";
        $products = Products::where('type', $type);
        if(isset($_GET['keyword'])){
            $search['keyword']=$_GET['keyword'];
            $products = $products->where('name', 'like',$_GET['keyword'].'%');
        }else{
            $search['keyword']=null;
        }
       
        $products = $products->paginate(15);



        return view('admin.products.index', [
            'products' => $products,
            'type' => $type,
            'search' => $search,
            
        ]);
    }

    public function create() {

        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = 'simple';
        }
        $url = null;
        $allCategories = Categories::orderBy('parent_id', 'asc')->get();
        $categories = Functions::getCategories($allCategories);
        $productTags = NULL;
        $productsCategories = NULL;
        $key = NULL;
        return view('admin.products.create', compact('categories', 'attributes', 'productAttributes', 'productsCategories', 'type', 'categories', 'key'));
    }

    public function insert(Request $request) {

        $rules = [
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'key' => 'required|unique:urls'
        ];

        //$rules['url'] = 'required';
        $rules['description'] = 'required';
        $rules['image'] = 'mimes:jpeg,bmp,png,gif';

        if ($request->sale == 1) {
            $rules['salePrice'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);
        $fileName = "";
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/products/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';
            $fileName = Functions::saveImage($file, $destinationPath, $destinationPathThumb);
            $upload = Image::make($destinationPath . $fileName)->fit(280)->save($destinationPathThumb . $fileName);
        }


        $model = new Products;
        $model->name = $request->name;
        $model->price = $request->price;
        $model->sku = $request->sku;
        $model->requirments = $request->requirments;
        $model->teaser = $request->teaser;
        $model->description = $request->description;
        $model->keywords = $request->keywords;
        $model->image = $fileName;
        $model->sale = $request->sale;
        $model->salePrice = $request->salePrice;
        $model->priceForDoctors = $request->priceForDoctors;
        $model->type = $request->type;
        $model->save();

        if (!empty($request['categories'])) {

            foreach ($request['categories'] as $category_id) {
                $categoryModel = new ProductsCategories();
                $categoryModel->product_id = $model->id;
                $categoryModel->category_id = $category_id;
                $categoryModel->save();
            }
        }
        $input = array();
        $input['type_id'] = $model->id;
        $input['key'] = $request->key;
        $input['type'] = 'product';
        $url = Urls::saveUrl($input);

        \Session::flash('message', 'Product add Successfully!');

        return redirect('admin/products?type=' . $request->type);
    }

    public function edit($id) {
        $product = Products::findOrFail($id);
        $selectedCategories = ProductsCategories::where('product_id', $id)->get();
        $productsCategories = array();
        foreach ($selectedCategories as $pc) {
            $productsCategories[] = $pc->category_id;
        }

        $url = Urls::where('type', 'product')->where('type_id', $id)->first();
        if (!empty($url)) {
            $key = $url->key;
        } else {
            $key = null;
        }

        $allCategories = Categories::orderBy('parent_id', 'asc')->get();
        $categories = Functions::getCategories($allCategories);


        $type = $product->type;
        return view('admin.products.edit', compact('product', 'categories', 'productsCategories', 'type', 'key', 'url'))->with('id', $id);
    }

    public function update($id, Request $request) {

        $rules = [
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'key' => 'required'
        ];

        $rules['description'] = 'required';
        $rules['image'] = 'mimes:jpeg,bmp,png,gif';

        if ($request->sale == 1) {
            $rules['salePrice'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);
        $fileName = "";
       
// cysticercus-antibody 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $urlCheck = Urls::where('type_id', '!=', $id)->where('type', '=', 'product')->where('key', $request->key)->get();

        if (count($urlCheck) > 0) {
            $validator->errors()->add('error_db', 'Key url is already taken.');
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $id = $request->id;
        $product = Products::findOrFail($id);
        $input = $request->all();

        if (Input::hasFile('image')) {

            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/products/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->fit(280)->save($destinationPathThumb . $fileName);
            $input['image'] = $fileName;
        }

        if (!isset($input['sale'])) {
            $input['sale'] = 0;
        }
        unset($input['type_id']);
        unset($input['key']);
        unset($input['_token']);
        unset($input['attributes']);
        unset($input['categories']);

        $affectedRows = Products::where('id', '=', $id)->update($input);

        if (!empty($request['categories'])) {
            $productsCategories = ProductsCategories::where('product_id', $id)->delete();


            foreach ($request['categories'] as $category_id) {
                $categoryModel = new ProductsCategories;
                $categoryModel->product_id = $id;
                $categoryModel->category_id = $category_id;
                $categoryModel->save();
            }
        }
        $input = array();
        $input['type_id'] = $id;
        $input['key'] = $request->key;
        $input['type'] = 'product';
        $url = Urls::saveUrl($input);

        return redirect('admin/products?type=' . $product->type);
    }

    public function delete($id) {
        $row = Products::where('id', '=', $id)->delete();
        $url = Urls::deleteUrl('product', $id);
        return redirect('admin/products');
    }

}
