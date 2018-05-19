<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\AdminController;
use DB;
use App\Guestbook;
use App\Functions\Functions;
use Auth;
use Session;

class GuestbookController extends AdminController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * All Cafe's For Admin.
     */
    public function index() {
        // $messages =Guestbook::where('id', '=', $id)->all();
        // return view('admin.guestbook',[
        // 'messages' => $messages,
        // ]);

        $sql = "SELECT
		`id`,
		`name`,
		`email`,
		`message`,
		`user_id`,
		`status`,
		`created_at`,
		`updated_at`
		FROM `guestbook`
		
		ORDER BY id DESC
		LIMIT 0, 1000;";
        $messages = DB::select($sql);

        return view('admin.guestbook', compact('messages'));
    }

    public function delete($id) {
        $row = Guestbook::where('id', '=', $id)->delete();
        return redirect('admin/guestbook');
    }

    public function update($id, $status) {
        $input = array();
        $input['status'] = $status;
        $row = Guestbook::where('id', '=', $id)->update($input);
        return redirect('admin/guestbook');
    }

}
