<?php 
namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect; 

use App\DiscountCoupons;
use Illuminate\Http\Request;

class CouponsController extends Controller {

    private $sessionId;
    public function __construct()
    {
        session_start();
        $this->sessionId=session_id();
    }

    public function apply(Request $request)
    {
   
        $coupon=DiscountCoupons::where("code",$request->coupon)->limit(1)->get();
        $now=time();
        $valid=true;
        //strtotime(date($coupon[0]->endDate));
        
        if(empty($coupon[0]))
        {
            
            $valid=false;
           \Session::flash('error', 'Sorry! Coupon is not found.');  
        }elseif($coupon[0]->used>=$coupon[0]->maxUse)
        {
            $valid=false;
           \Session::flash('error', 'Sorry! Coupon is used up.');  
        }
        elseif($now>=strtotime(date($coupon[0]->endDate)))
        {
            $valid=false;
            \Session::flash('error', 'Sorry! this coupon is expired.'); 
        }
        elseif($now<strtotime(date($coupon[0]->startDate)))
        {
            $valid=false;
            \Session::flash('error', 'Please! apply this coupon on '.date("d F Y",strtotime(date($coupon[0]->startDate)))." and onwards."); 
        }
        elseif($request->subTotal<$coupon[0]->minOrder)
        {
            $valid=false;
            //echo "here4";
            \Session::flash('error', 'You order should be minimum $'.$coupon[0]->minOrder.'.');   
        }
        if($valid==true)
        {
            $salePrice=$request->subTotal * (1 - $coupon[0]->amount/100);
            $discount=$request->subTotal-$salePrice;
            $data['salePrice']=$salePrice;
            $data['discount']=$discount;
            $data['coupons']=$coupon[0];
            Session::put('coupon',$data);
            Session::put('validDiscount',1);
            return redirect("cart/view");
        }
        else
        {
            Session::put('validDiscount',0);
            return redirect("cart/view");
        }
    }
}