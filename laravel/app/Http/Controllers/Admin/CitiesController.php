<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use Auth;
use App\Cities;
use App\States;
use Illuminate\Http\Request;

class CitiesController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $model = Cities::orderBy('title', 'asc')->get();
        return view('admin.cities.index', compact('model'));
    }

    public function create() {
        $states = States::lists('title', 'code');
        $cityState = array();
        return view('admin.cities.create', compact('states', 'productsCategories'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required|max:50|unique:cities',
                    'state_id' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $model = new Cities;
        $model->title = $request->title;
        $model->state_id = $request->state_id;
        $model->save();
        \Session::flash('success', 'City added successfully!');
        return redirect('admin/cities');
    }

    public function show($id) {
        $row = Cities::where('id', '=', $id)->get();
        return view('admin.cities.view')->with('result', $row);
    }

    public function edit($id) {
        $model = Cities::findOrFail($id);
        $states = States::lists('title', 'code');
        return view('admin.cities.edit', compact('states', 'model'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;

        $category = Cities::findOrFail($id);


        $input = $request->all();

        unset($input['_wysihtml5_mode']);
        unset($input['_token']);
        $affectedRows = Cities::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Post updated successfully!');
        return redirect('admin/cities');
    }

    public function delete($id) {
        $row = Cities::where('id', '=', $id)->delete();
        return redirect('admin/cities');
    }

}
