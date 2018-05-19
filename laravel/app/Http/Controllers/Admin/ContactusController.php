<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator,
    Input,
    Redirect;
use App\Http\Controllers\AdminController;
use DB;
use App\Contactus;
use App\Functions\Functions;
use Auth;
use Session;

/**
 * ContactusController
 * 
 * @package   
 * @author too_cute
 * @copyright lolkittens
 * @version 2016
 * @access public
 */
class ContactusController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    /**
     * ContactusController::__construct()
     * 
     * @return
     */

    /**
     * ContactusController::__construct()
     * 
     * @return
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * All Cafe's For Admin.
     */
    /**
     * ContactusController::index()
     * 
     * @return
     */

    /**
     * ContactusController::index()
     * 
     * @return
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
		`status`,
		`created_at`,
		`updated_at`
		FROM `contactus`

		ORDER BY id DESC
		;";
        $contactus = DB::select($sql);

        return view('admin.contactus', compact('contactus'));
    }

    /**
     * ContactusController::delete()
     * 
     * @param mixed $id
     * @return
     */

    /**
     * ContactusController::delete()
     * 
     * @return
     */
    public function delete($id) {
        $row = Guestbook::where('id', '=', $id)->delete();
        return redirect('admin/guestbook');
    }

    /**
     * ContactusController::detail()
     * 
     * @param mixed $id
     * @return
     */

    /**
     * ContactusController::detail()
     * 
     * @return
     */
    public function detail($id) {

        $contactus = Contactus::where('id', '=', $id)->first();
        return view('admin.contactusdetail', compact('contactus'));
    }

}
