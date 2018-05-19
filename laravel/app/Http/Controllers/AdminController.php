<?php 
namespace App\Http\Controllers;
use Auth;
use App\Role;
class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
            session_start();
            $this->middleware('auth');
            
            
            self::checkRole();
	}
        
        
        public static function checkRole()
        {
            if(isset(Auth::user()->id)){
            $role=Role::find(Auth::user()->role_id);
                if($role->role!='admin')
                {
                    header("Location:".url(''));
                    die;
                }
            }
            else
            {
                    header("Location:".url('login'));
                    die;
            }
        }
}