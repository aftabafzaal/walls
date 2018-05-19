<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator,
    Input,
    Redirect;
use App\BlogCategories;
use App\BlogPosts;
use Illuminate\Http\Request;

class BlogController extends Controller {

    private $sessionId;

    public function __construct() {
        session_start();
        $this->sessionId = session_id();
    }

    public function index($key = "") {
        $querystringArray = array();
        $posts = BlogPosts::where("status", "=", 1);


        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $posts = $posts->where("name", "like", "%$q%");
            $querystringArray = ['q' => $q];
        } elseif ($key != "") {
            $category = BlogCategories::where('url', $key)->first();
            $posts = $posts->where("category_id", "=", $category->id);
        }
        $posts = $posts->orderBy('id', 'desc')->paginate(9);
        $link = str_replace("blog/?", "blog?", $posts->appends($querystringArray)->render());
        return view('front.blog.index', compact('posts', 'q', 'link'));
    }

    public function post($key = "") {
        $post = BlogPosts::where('url', $key)->first();
        $similarPosts = BlogPosts::where("category_id", '=', $post->id)->limit(3)->get();
        return view('front.blog.post', compact('post', 'similarPosts'));
    }

}
