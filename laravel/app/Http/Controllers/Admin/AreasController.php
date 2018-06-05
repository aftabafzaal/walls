<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use Auth;
use App\Cities;
use App\Areas;
use App\User;
use Illuminate\Http\Request;

class AreasController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $model = Areas::orderBy('title', 'asc')->get();
        
        return view('admin.areas.index', compact('model'));
    }

    public function create() {
        $cities = Cities::lists('title', 'id');
        $managers = User::where('role_id', '3')->lists('email','id');
        
        $cityState = array();
        
        return view('admin.areas.create', compact('cities', 'cityState','managers'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'title' => 'required|max:50|unique:areas',
                    'city_id' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $model = new Areas;
        $model->title = $request->title;
        $model->city_id = $request->city_id;
        $model->user_id = $request->user_id;
        $model->save();
        \Session::flash('success', 'City added successfully!');
        return redirect('admin/areas');
    }

    public function show($id) {
        $row = Areas::where('id', '=', $id)->get();
        return view('admin.areas.view')->with('result', $row);
    }

    public function edit($id) {
        $model = Areas::findOrFail($id);
        $managers = User::where('role_id', '3')->lists('email','id');
        $cities = Cities::lists('title', 'id');
        return view('admin.areas.edit', compact('cities', 'model','managers'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;

        $category = Areas::findOrFail($id);


        $input = $request->all();

        unset($input['_wysihtml5_mode']);
        unset($input['_token']);
        $affectedRows = Areas::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Post updated successfully!');
        return redirect('admin/areas');
    }

    public function delete($id) {
        $row = Areas::where('id', '=', $id)->delete();
        return redirect('admin/areas');
    }

}
