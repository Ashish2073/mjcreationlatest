<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\RegistrationController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\Dashboard\ProductController;






// Route::get("vendors/welcome",function(){
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('users.registration');
// });

// Route::group(['prefix' => LaravelLocalization::setLocale()], function ()
// {
//     // Your other localized routes...

//     Livewire::setUpdateRoute(function ($handle) {
//         return Route::post('/livewire/update', $handle);
//     });
// });

Route::get('/', function () {
    return view('website.users.registration');
});

Route::get('/testi', function () {
    return view('managedashboard.product.test2');
});


Route::get('vendors/home', function () {
    return view('managedashboard.index');
});



Route::post('users/registration', [RegistrationController::class, 'register'])->name('users-registration');

Route::get('users/verification', [RegistrationController::class, 'verificationview']);
Route::get('users/login', [LoginController::class, 'usersloginview'])->name('users-login');

Route::post('users/otpverification', [RegistrationController::class, 'verifiedOtp'])->name('user-otpverification');

Route::post('users/otpresend', [RegistrationController::class, 'otpresend'])->name('user-otpresend');

Route::post('users/authlogin', [LoginController::class, 'usersauthlogin'])->name('users-auth-login');

Route::get('users/home', [LoginController::class, 'homeview'])->name('users-home-view');







//vendors///////


Route::get('vendors/addproduct', [ProductController::class, 'vendorproductview'])->name('vendors-addproduct');

Route::post('vendors/subproduct-categories', [ProductController::class, 'handleChange'])->name('vendors-subproduct-categories');

Route::post('vendors/saveproduct', [ProductController::class, 'saveproduct'])->name('vendor-saveproduct');

Route::post('vendors/product-textarea-image-upload', [ProductController::class, 'textareaimageupload'])->name('product-textarea-image-upload');

Route::post('vendors/productlistshow', [ProductController::class, 'productlistshow'])->name('vendors.productlistshow');
Route::get('vendors/productlist', [ProductController::class, 'productlistview'])->name('vendors.productlist');
// Route::get('vendors/productlist',Producttable::class)->name('vendors.productlist');

Route::post('vendors/addbrandname', [ProductController::class, 'addbrandname'])->name('vendors.addbrandname');
///importdata////////////
Route::get('import/bulkproduct', [ProductController::class, 'bulkimport'])->name('bulk.import');
Route::post('import/product', [ProductController::class, 'importproductdata'])->name('import.product.data');

Route::post('import/productspecification', [ProductController::class, 'importproductspecificationdata'])->name('import.product.specification.data');

Route::post('import/productprimarycost', [ProductController::class, 'importproductprimarycostdata'])->name('import.product.primary.cost.data');
