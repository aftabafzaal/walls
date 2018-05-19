<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::filter('force.ssl', function() {
    if (!Request::secure()) {
        return Redirect::secure(Request::path());
    }
});

Route::get('/', ['uses' => 'HomeController@index', 'https' => true]);
Route::get('home', ['uses' => 'HomeController@index', 'https' => true]);
Route::get('how-to-order', 'HomeController@howtoorder');
Route::get('about-us', 'HomeController@aboutus');
Route::get('faq', 'HomeController@faq');
Route::get('terms', 'HomeController@terms');
Route::get('privacy', 'HomeController@privacy');
Route::get('locations', 'HomeController@locations');
Route::get('location/{id}', 'HomeController@location');
Route::get('contacts', ['uses' => 'HomeController@contacts', 'https' => true]);

Route::get('bundle', 'HomeController@bundle');
Route::get('locations/get', 'LocationsController@getLocations');

Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController',]);
Route::get('contact-us', 'ContactusController@contact');
Route::post('contact-send', 'ContactusController@store');
Route::get('search', 'HomeController@search');
Route::get('products/{id}', 'HomeController@products');
Route::get('shop', 'HomeController@products');
Route::get('product/{key}', 'HomeController@getproduct');
Route::get('page/{code}', 'PageController@view');
Route::get('/guestbook', [
    'uses' => 'HomeController@guestbook',
    'as' => 'guestbook.messages',
]);

Route::get('verification', 'HomeController@verification');

Route::get('forgot', 'SignupController@forgot_password');
Route::post('reset', 'SignupController@reset_password');
Route::post('savemessage', 'HomeController@messagePost');
Route::get('page/{code}', 'PageController@view');
Route::get('myorders', 'OrdersController@myorders');
Route::get('order/{id}', 'OrdersController@order');
Route::get('cart/add', 'CartController@add');
Route::get('cart/addsimple', 'CartController@addsimple');
Route::get('cart/updateproductprice', 'CartController@updateproductprice');
Route::get('cart/view', 'CartController@mycart');
Route::get('cart/', 'CartController@mycart');
Route::get('cart/delete/{id}', 'CartController@delete');
Route::get('cart/update', 'CartController@update');
Route::get('checkout', 'CheckoutController@index');
Route::post('postOrder', 'CheckoutController@order');
Route::get('checkout/success/{id}', 'CheckoutController@success');
Route::get('checkout/fail', 'CheckoutController@fail');
Route::get('success/{id}', 'SignupController@success');
Route::get('mycart', 'CartController@index');
Route::get('profile', 'ProfileController@index');
Route::get('clients', 'ClientsController@index');
Route::get('admin/client/{id}', 'ClientsController@userDetail');
Route::post('admin/clientOrderStatus', 'ClientsController@ordersBystatus');

Route::get('connect', 'SignupController@doctors_login');
Route::get('login', 'SignupController@index');
Route::get('signup', 'SignupController@index');

Route::get('register', 'SignupController@register');
Route::get('register_doctor', 'SignupController@register_doctor');
Route::post('signUpPost', 'SignupController@store');
Route::post('postLogin', 'SignupController@postLogin');

Route::get('changepassword', 'CustomersController@changepassword');
Route::post('postchangepassword', 'CustomersController@postchangepassword');
Route::get('profile', 'CustomersController@profile');
Route::post('updateprofile', 'CustomersController@updateprofile');
Route::post('coupons/apply', 'CouponsController@apply');

Route::group(
        array('prefix' => 'paypal'), function() {
    $folder = "Payments\\";
    Route::get('success', $folder . 'PaypalController@success');
    Route::get('cancel', $folder . 'PaypalController@cancel');
}
);

Route::group(
        array('prefix' => 'check'), function() {
    $folder = "Payments\\";
    Route::get('success', $folder . 'CheckController@success');
    Route::get('cancel', $folder . 'CheckController@cancel');
}
);

Route::get('blog', 'BlogController@index');
Route::get('blog/{key}', 'BlogController@index');
Route::get('blog/post/{key}', 'BlogController@post');

Route::get('test/document', 'TestController@index');
Route::get('test/results', 'TestController@results');
Route::get('test/acknowledgement', 'TestController@acknowledgement');

Route::group(
        array('prefix' => 'admin'), function() {
    $admin = "Admin\\";

    Route::get('/', $admin . 'HomeController@index');
    Route::get('home', $admin . 'HomeController@index');

    Route::get('categories', $admin . 'CategoriesController@index');
    Route::get('categories/create', $admin . 'CategoriesController@create');
    Route::get('categories/createSubcat', $admin . 'CategoriesController@create_sub_cat');
    Route::post('categories/storeSubcat', $admin . 'CategoriesController@store_sub_cat');
    Route::post('categories/insert', $admin . 'CategoriesController@insert');
    Route::get('categories/delete/{id}', $admin . 'CategoriesController@delete');
    Route::get('categories/edit/{id}', $admin . 'CategoriesController@edit');
    Route::post('categories/update/{id}', $admin . 'CategoriesController@update');

    Route::get('products', $admin . 'ProductsController@index');
    Route::get('products/create', $admin . 'ProductsController@create');
    Route::post('products/insert', $admin . 'ProductsController@insert');
    Route::get('products/delete/{id}', $admin . 'ProductsController@delete');
    Route::get('products/edit/{id}', $admin . 'ProductsController@edit');
    Route::post('products/update/{id}', $admin . 'ProductsController@update');

    Route::get('content', $admin . 'ContentController@index');
    Route::get('content/create', $admin . 'ContentController@create');
    Route::post('content/insert', $admin . 'ContentController@insert');
    Route::get('content/edit/{id}', $admin . 'ContentController@edit');
    Route::post('content/update/{id}', $admin . 'ContentController@update');
    Route::get('content/delete/{id}', $admin . 'ContentController@delete');

    Route::get('contactus', $admin . 'ContactusController@index');
    Route::get('contactusdetail/{id}', $admin . 'ContactusController@detail');

    Route::get('orders', $admin . 'OrdersController@index');
    Route::get('order/{id}', $admin . 'OrdersController@order');

    Route::post('orderStatus', $admin . 'OrdersController@order_status');
    Route::post('order/updateOrderStatus', $admin . 'OrdersController@update_order_status');

    Route::get('orders/results/{order_id}', $admin . 'OrdersresultsController@create');
    Route::get('orders/results/edit/{order_id}', $admin . 'OrdersresultsController@edit');
    Route::post('orders/results/insert', $admin . 'OrdersresultsController@insert');
    Route::post('orders/results/update/{id}', $admin . 'OrdersresultsController@update');
    Route::get('orders/results/delete/{id}', $admin . 'OrdersresultsController@delete');
    Route::get('order/delete/{id}', $admin . 'OrdersController@delete');

    Route::get('blog/categories', $admin . 'BlogCategoriesController@index');
    Route::get('blog/categories/create', $admin . 'BlogCategoriesController@create');
    Route::post('blog/categories/insert', $admin . 'BlogCategoriesController@insert');
    Route::get('blog/categories/delete/{id}', $admin . 'BlogCategoriesController@delete');
    Route::get('blog/categories/edit/{id}', $admin . 'BlogCategoriesController@edit');
    Route::post('blog/categories/update/{id}', $admin . 'BlogCategoriesController@update');

    Route::get('blog/posts', $admin . 'BlogPostsController@index');
    Route::get('blog/posts/create', $admin . 'BlogPostsController@create');
    Route::post('blog/posts/insert', $admin . 'BlogPostsController@insert');
    Route::get('blog/posts/delete/{id}', $admin . 'BlogPostsController@delete');
    Route::get('blog/posts/edit/{id}', $admin . 'BlogPostsController@edit');
    Route::post('blog/posts/update/{id}', $admin . 'BlogPostsController@update');
}
);
