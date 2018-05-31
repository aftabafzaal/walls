<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use Auth;
use App\Cities;
use Session;
use Illuminate\Http\Request;

class CitiesController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $posts = Cities::orderBy('name', 'asc')->get();
        return view('admin.cities.posts.index', compact('posts'));
    }

    public function create() {
        $categories = BlogCategories::lists('name', 'id');
        $productsCategories = array();
        return view('admin.cities.posts.create', compact('categories', 'productsCategories'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:150|unique:cities',
                    
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $model = new Cities;
        $model->name = $request->name;
        $model->save();
        \Session::flash('success', 'City added successfully!');
        return redirect('admin/cities');
    }

    public function show($id) {
        $row = Cities::where('id', '=', $id)->get();
        return view('admin.cities.view')->with('result', $row);
    }

    public function edit($id) {
        $post = Cities::findOrFail($id);
        $categories = BlogCategories::lists('name', 'id');
        return view('admin.cities.posts.edit', compact('post', 'categories'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;

        $category = Cities::findOrFail($id);


        $input = $request->all();

        unset($input['_wysihtml5_mode']);
        unset($input['_token']);
        $affectedRows = Cities::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Post updated successfully!');
        return redirect('admin/cities/posts');
    }

    public function delete($id) {
        $row = Cities::where('id', '=', $id)->delete();
        return redirect('admin/cities/posts');
    }

}
