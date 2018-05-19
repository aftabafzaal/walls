<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\LabsLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator,
    Input,
    Redirect;
use App\Functions\Functions;

class LocationsController extends Controller {

    protected $layout = 'layouts.search';

    public function __construct() {
        
    }

    public function getLocations(Request $request) {
        $q = $request->input('q');
        $longitude = -89.9806161;
        $latitude = 38.7788547;

        if (is_numeric($q)) {
            $l=$q-1000;
            $r=$q+1000;
            $subSql=" and `zip` BETWEEN $l and $r ";
        }else
        {
            $subSql=" and (address like '%$q%' || zip  like '%$q%' || city  like '%$q%' || state  like '%$q%' ) ";
        }

        echo $sql = "select * from labs_locations 
        where (longitude<>0 and latitude!=0) ".$subSql." group by id ORDER BY `zip` asc limit 50;";
        $locations = DB::select($sql);
        return view('front.locations.suggested', compact('q', 'locations'));
    }

}
