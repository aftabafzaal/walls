<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\AdminController;
use DB;
use App\Orders;
use Config;
use App\User;
use App\Content;
use App\OrdersResults;
use App\Functions\Functions;
use Auth;
use Session;

class OrdersresultsController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function create($order_id) {

        return view('admin.orders_results.create', compact('order_id'));
    }

    public function insert(Request $request) {

        $validator = Validator::make($request->all(), [
                    'title' => 'required|max:50',
                    'remarks' => '|max:300',
                    'order_id' => 'required',
                    'file' => 'required|mimes:jpeg,pdf,docx,jpg,txt|max:5220', // 5 Mb
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = $request->all();
        unset($input['_token']);
        unset($input['save']);

        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $destinationPath = public_path() . '/uploads/orders/results/';
            $extension = $file->getClientOriginalExtension();
            $fileName = $input['order_id'] . '_' . rand(111, 999) . time() . '.' . $extension;
            $upload_success = $file->move($destinationPath, $fileName);
            $input['file'] = $fileName;
        }
        $input['created_at'] = date('Y-m-d H:i:s');

        $id = OrdersResults::insertGetId($input);

        \Session::flash('success', 'Result added successfully!');
        return redirect('admin/order/' . $input['order_id']);
    }

    public function edit($id) {
        $model = OrdersResults::findOrFail($id);
        $order_id = $model->order_id;
        return view('admin.orders_results.edit', compact('model', 'order_id'));
    }

    public function update($id, Request $request) {

        $validator = Validator::make($request->all(), [
                    'title' => 'required|max:50',
                    'remarks' => 'max:300',
                    'order_id' => 'required',
                    'file' => 'mimes:jpeg,pdf,docx,jpg,txt|max:5220', // 5 Mb
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $input = $request->all();
        unset($input['_token']);
        unset($input['save']);

        if (Input::hasFile('file')) {
            $model = OrdersResults::findOrFail($id);
            $file = Input::file('file');
            $destinationPath = public_path() . '/uploads/orders/results/';
            $extension = $file->getClientOriginalExtension();
            $fileName = $input['order_id'] . '_' . rand(111, 999) . time() . '.' . $extension;
            $upload_success = $file->move($destinationPath, $fileName);
            unlink(public_path() . '/uploads/orders/results/' . $model->file);
            $input['file'] = $fileName;
        }

        $input['updated_at'] = date('Y-m-d H:i:s');
        $affectedRows = OrdersResults::where('id', '=', $id)->update($input);

        if ($request->save == 'email') {
            self::email_result($id);
        }


        \Session::flash('success', 'Result updated successfully!');
        return redirect('admin/order/' . $input['order_id']);
    }

    public static function email_result($id) {
        $model = OrdersResults::where('id', '=', $id)->first();
        $orderModel = Orders::getOrderDetailByPk($model->order_id);
        $userModel = User::where('id', '=', $orderModel->user_id)->first();

        $content = Content::where('code', '=', 'order_result')->get();
        $replaces['NAME'] = $orderModel->billingName;
        $orderPrefix = Config::get('params.order_prefix');
        $replaces['ID'] = $orderPrefix . $orderModel->id;
        $replaces['ORDER_LINK'] = url('order/' . $model->order_id);
        $replaces['ACCOUNT'] = '<a href="' . url('order/' . $model->order_id) . '" >My Account</a>';
        $template = Functions::setEmailTemplate($content, $replaces);
        $mail = Functions::sendEmail($orderModel->email, $template['subject'], $template['body']);

        $input['lastEmail'] = date('Y-m-d H:i:s');
        OrdersResults::where('id', '=', $id)->update($input);
    }

    public function delete($id, Request $request) {
        $model = OrdersResults::where('id', '=', $id);
        $result = $model->first();
        $destinationPath = public_path() . '/uploads/orders/results/' . $result->file;
        unlink($destinationPath);
        $model->delete();

        \Session::flash('success', 'Result deleted successfully!');
        return redirect('admin/order/' . $result->order_id);
    }

}
