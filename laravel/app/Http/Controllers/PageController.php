<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\Content;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use View;
use DbView;

class PageController extends Controller {

    public function view($code) {
        $model = Content::where('code', '=', $code)->first();
        return view('front.page',compact('model'));
    }

}
