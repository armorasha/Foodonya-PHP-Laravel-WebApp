<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/






//-----vvvvvvvvvvvvvvvvv----THE ORDER OF THE BELOW ROUTES MATTERS! SEE: LARACAST EPISODE-23, 1:00

Route::get('/', function () {
    return view('welcome');
});
//Explanation: When the user makes a get request to the home page '/', 
//in response we are loading the view 'welcome'. See below comment too.


Route::get('/about', function(){
    return view('about');
});
// '/about' is from the browser addressbar as in foodonya.com/about
// 'about' is the page name about.blade.php


Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});


Route::get('/menu', 'ProductsController@getAllCategoriesAndProducts'); //returns view from the controller, not from here

Route::get('/products/{product_id}', 'ProductsController@showSelected'); //here products is the folder not a view

//Route::get('/cart', 'CartController@show'); //here products is the folder not a view

//Route::get('/products/{product_id}/edit', 'ProductsController@edit'); //This can edit a product. See Ep:24, 0:33. Here products is the folder not a view


/* Route::get('/cart', function () { //url can be /cart and view can be in /shopping/cart.blade.php (shopping is the folder name)
    return view('shopping.cart');
}); */

Route::get('/add-to-cart', 'CartController@addProduct');
/* Route::get('/cart/{product}/{size_code}/{qty}', 'CartController@addProduct');*/

Route::resource('/cart', 'CartController', ['only' => ['index', 'addProduct', 'store', 'update', 'destroy', 'emptyCart']]);
//was getting a show() not found error, so I am using 'only' to define what methods I am using..
//..otherwise i dont need ['only' => ['index', 'addProduct', 'store', 'update', 'destroy', 'emptyCart']]

Route::get('/payment', function () {
    return view('shopping.payment');
});



//for ajax test
// Route::get('/cart1', function () {
//     return view('cart');
// });
// Route::post('/cartAjax', 'CartController@index1');

//for ajax test
// Route::get('/payment1', function () {
//     return view('payment');
// });
Route::post('/paymentAjax/{paymentSelection}', 'CartController@getPaymentContent');


/*Route::get('/member', function () {
    return view('member');
});*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/app', function () {
    return view('layouts.app');
});