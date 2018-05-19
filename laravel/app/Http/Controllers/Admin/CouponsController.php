<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;
use Validator,
    Input,
    Redirect;
use DB;
use Auth;
use App\DiscountCoupons;
use App\Functions\Functions;
use Session;
use Illuminate\Http\Request;

class CouponsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $model = DiscountCoupons::all();
        return view('admin.discount_coupons.index', ['model' => $model]);
    }

    public function create() {
        return view('admin.discount_coupons.create');
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
                    'description' => 'required|max:255|unique:discount_coupons',
                    'startDate' => 'required|date',
                    'endDate' => 'required|date|after:startDate',
                    'minOrder' => 'required|numeric',
                    'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors(), 'errors');
        }

        $code = Functions::generateRandomString(10);
        $model = new DiscountCoupons;
        $model->code = $code;
        $model->startDate = $request->startDate;
        $model->endDate = $request->endDate;
        $model->maxUse = $request->maxUse;
        $model->minOrder = $request->minOrder;
        $model->amount = $request->amount;
        $model->description = $request->description;
        $model->save();
        \Session::flash('success', 'Coupons Added Successfully!');
        return redirect('admin/coupons');
    }

    public function edit($id) {
        $model = DiscountCoupons::findOrFail($id);
        return view('admin.discount_coupons.edit', compact('model'))->with('id', $id);
    }

    public function update($id, Request $request) {
        $id = $request->id;
        $input = $request->all();
        unset($input['_token']);
        $affectedRows = DiscountCoupons::where('id', '=', $id)->update($input);

        \Session::flash('message', 'Updated Successfully!');
        return redirect('admin/coupons');
    }

    public function delete($id) {
        $row = DiscountCoupons::where('id', '=', $id)->delete();
        return redirect('admin/coupons');
    }

}
