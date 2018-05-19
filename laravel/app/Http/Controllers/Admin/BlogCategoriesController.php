<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use DB;
use Auth;
use App\BlogCategories;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class BlogCategoriesController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $categories = BlogCategories::orderBy('name', 'asc')->get();
        return view('admin.blog.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create() {
        $result = BlogCategories::lists('name', 'id');
        return view('admin.blog.categories.create');
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255|unique:blog_categories',
                    
                    'image' => 'mimes:jpeg,bmp,png,gif',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $model = new BlogCategories;

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/blog/categories/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->resize(150, 150)->save($destinationPathThumb . $fileName);
            $model->image = $fileName;
        }

        $model->name = $request->name;
        $model->description = $request->description;
        $model->url = $request->url;
        $model->save();
        \Session::flash('success', 'Category Added Successfully!');
        return redirect('admin/blog/categories');
    }

    public function show($id) {
        $row = BlogCategories::where('id', '=', $id)->get();
        return view('admin.blog.view')->with('result', $row);
    }

    public function edit($id) {
        $category = BlogCategories::findOrFail($id);
        return view('admin.blog.categories.edit', compact('category'))->with('id', $id);
    }

    public function update($id,
            Request $request) {
        $id = $request->id;

        $category = BlogCategories::findOrFail($id);


        $input = $request->all();

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/categories/';
            $destinationPathThumb = $destinationPath . 'thumbnail/';

            $extension = $file->getClientOriginalExtension();
            $fileName = rand(111, 999) . time() . '.' . $extension;
            $image = $destinationPath . '/' . $fileName;
            $upload_success = $file->move($destinationPath, $fileName);
            $upload = Image::make($image)->resize(150, 150)->save($destinationPathThumb . $fileName);
            $input['image'] = $fileName;
        }
        unset($input['_wysihtml5_mode']);
        unset($input['_token']);
        
        $affectedRows = BlogCategories::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Updated Successfully!');
        return redirect('admin/blog/categories');
    }

    public function delete($id) {
        $row = BlogCategories::where('id', '=', $id)->delete();
        return redirect('admin/blog/categories');
    }

}
