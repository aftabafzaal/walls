<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use DB;
use Auth;
use App\BlogPosts;
use App\BlogCategories;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class BlogPostsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $posts = BlogPosts::orderBy('name', 'asc')->get();
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create() {
        $categories = BlogCategories::lists('name', 'id');
        $productsCategories = array();
        return view('admin.blog.posts.create', compact('categories', 'productsCategories'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:150|unique:blog_posts',
                    'category_id' => 'required',
                    'description' => 'required',
                    'teaser' => 'required|max:500',
                    'image' => 'mimes:jpeg,png,gif',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $model = new BlogPosts;

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/blog/posts/';
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
        $model->category_id = $request->category_id;
        $model->teaser = $request->teaser;
        $model->tags = $request->tags;
        $model->user_id = Auth::user()->id;
        $model->keywords = $request->keywords;
        $model->metaDescription = $request->metaDescription;
        $model->url = $request->url;
        $model->save();
        \Session::flash('success', 'Post added successfully!');
        return redirect('admin/blog/posts');
    }

    public function show($id) {
        $row = BlogPosts::where('id', '=', $id)->get();
        return view('admin.blog.view')->with('result', $row);
    }

    public function edit($id) {
        $post = BlogPosts::findOrFail($id);
        $categories = BlogCategories::lists('name', 'id');
        return view('admin.blog.posts.edit', compact('post', 'categories'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;

        $category = BlogPosts::findOrFail($id);


        $input = $request->all();

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $destinationPath = public_path() . '/uploads/blog/posts/';
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
        $affectedRows = BlogPosts::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Post updated successfully!');
        return redirect('admin/blog/posts');
    }

    public function delete($id) {
        $row = BlogPosts::where('id', '=', $id)->delete();
        return redirect('admin/blog/posts');
    }

}
