<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\RegistrationController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProductDiscountController;
use App\Http\Controllers\Vendor\Auth\RegistrationController as VendorRegistrationController;
use App\Http\Controllers\Vendor\Auth\LoginController as VendorLoginController;
use App\Http\Controllers\Dashboard\VendorController as DashboardVendorController;
use App\Http\Controllers\Dashboard\CommisionController;
use App\Http\Controllers\Dashboard\VendorOrderManagmentController;






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


// Route::get('vendors/addproduct', [ProductController::class, 'vendorproductview'])->name('vendors-addproduct');

Route::prefix('vendors')->middleware('vendor.guest')->group(function () {
    Route::get('/', function () {
        return view('vendors.login');
    })->name('vendors');


    Route::get('/registration', function () {
        return view('vendors.registration');

    })->name('vendors.registration');

    Route::post('registration', [VendorRegistrationController::class, 'registration'])->name('vendors.registration');


    Route::post('/login', [VendorLoginController::class, 'vendorlogin'])->name('vendors.login')->middleware('throttle:5,10');

    Route::get('/otpvarifiaction', [VendorRegistrationController::class, 'otpvarification'])->name('vendors.otpvarification');

    Route::post('/otpmatch', [VendorRegistrationController::class, 'otpmatch'])->name('vendors.otpmatch');



});






Route::prefix('vendors')->middleware('vendor.auth')->group(function () {


    Route::post('/logout', [VendorRegistrationController::class, 'vendorlogout'])->name('vendors.logout');


    Route::post('subproduct-categories', [ProductController::class, 'handleChange'])->name('vendors-subproduct-categories');

    Route::post('saveproduct', [ProductController::class, 'saveproduct'])->name('vendor-saveproduct');

    Route::post('updateproduct', [ProductController::class, 'updateproduct'])->name('vendors.updateproduct');

    Route::post('editproduct', [ProductController::class, 'editproduct'])->name('vendor.editproduct');

    Route::post('deleteproduct', [ProductController::class, 'deleteproduct'])->name('vendor.deleteproduct');

    Route::post('product-textarea-image-upload', [ProductController::class, 'textareaimageupload'])->name('product-textarea-image-upload');

    Route::post('productlistshow', [ProductController::class, 'productlistshow'])->name('vendors.productlistshow');
    Route::get('productlist', [ProductController::class, 'productlistview'])->name('vendors.productlist');
    // Route::get('vendors/productlist',Producttable::class)->name('vendors.productlist');

    Route::post('addbrandname', [ProductController::class, 'addbrandname'])->name('vendors.addbrandname');
    ///importdata////////////

    Route::get('import/bulkproduct', [ProductController::class, 'bulkimport'])->name('bulk.import');
    Route::post('import/product', [ProductController::class, 'importproductdata'])->name('import.product.data');

    Route::post('import/productspecification', [ProductController::class, 'importproductspecificationdata'])->name('import.product.specification.data');

    Route::post('import/productprimarycost', [ProductController::class, 'importproductprimarycostdata'])->name('import.product.primary.cost.data');

    Route::post('product/image', [ProductController::class, 'productimage'])->name('product.image');

    Route::post('product/addmeasurmentname', [ProductController::class, 'productmeasurmentsave'])->name('product.addmeasurmentname');

    Route::post('product/addmeasurmentunitname', [ProductController::class, 'productmeasurmentunitsave'])->name('product.addmeasurmentunitname');

    Route::post('product/addspecificationheading', [ProductController::class, 'productaddspecificationheading'])->name('product.addspecificationheading');

    Route::post('productlist', [ProductDiscountController::class, 'productdiscountview'])->name('product.list');

    Route::post('product/addproductdiscount', [ProductDiscountController::class, 'saveproductdiscount'])->name('product.savediscount');

    Route::get('product/discountlist', [ProductDiscountController::class, 'productdiscountlistview'])->name('product.discountlist');

    Route::post('product/discount/edit', [ProductDiscountController::class, 'discounteditview'])->name('product.discount.edit');

    Route::post('product/updatediscount', [ProductDiscountController::class, 'productdiscountupdate'])->name('product.updatediscount');

    Route::post('product/deletediscount', [ProductDiscountController::class, 'deletediscount'])->name('product.deletediscount');

    Route::get('vendorlist', [DashboardVendorController::class, 'vendorlist'])->name('vendors.list');

    Route::post('vendorsdetail', [DashboardVendorController::class, 'vendordetails'])->name('vendor.detail');

    Route::post('statusupdate', [DashboardVendorController::class, 'statusupdate'])->name('vendors.statusupdate');

    Route::get('editprofile', [DashboardVendorController::class, 'editprofile'])->name('vendors.editprofile');

    Route::post('updateprofile', [DashboardVendorController::class, 'vendorupdateprofile'])->name('vendors.updateprofile');

    Route::get('vendorcommision', [CommisionController::class, 'vendorcomission'])->name('vendors.commision');

    Route::post('category', [CommisionController::class, 'vendorCategory'])->name('vendors.category');

    Route::post('commisionperorder', [CommisionController::class, 'vendorcommisionperorder'])->name('vendors.commisionperorder');

    Route::post('commisioncategory', [CommisionController::class, 'vendorcommisioncategory'])->name('vendors.commisioncategory');

    Route::post('editcommisioncategory', [CommisionController::class, 'editvendorcommisioncategory'])->name('vendors.editcommisioncategory');

    Route::post('updatecommisioncategory', [CommisionController::class, 'updatecommisioncategory'])->name('vendors.updatecommisioncategory');


    Route::post('deleteCategoryCommision', [CommisionController::class, 'deleteCategoryCommision'])->name('vendors.deleteCategoryCommision');

    Route::post('commisionproduct', [CommisionController::class, 'vendorcommisionproduct'])->name('vendors.commisionproduct');

    Route::post('commisionproduct', [CommisionController::class, 'vendorcommisionproduct'])->name('vendors.commisionproduct');

    Route::post('editvendorproductcommision', [CommisionController::class, 'editvendorproductcommision'])->name('vendors.editvendorproductcommision');


    Route::post('updatecommisionproduct', [CommisionController::class, 'updatecommisionproduct'])->name('vendors.updatecommisionproduct');

    Route::post('editordercommision', [CommisionController::class, 'editordercommision'])->name('vendors.editordercommision');

    Route::post('updatordercommision', [CommisionController::class, 'updatordercommision'])->name('vendors.updatordercommision');

    Route::post('deletevendorcommisionproduct', [CommisionController::class, 'deletevendorcommisionproduct'])->name('vendors.deletevendorcommisionproduct');

    Route::post('deletevendorcommisionperorder', [CommisionController::class, 'deletevendorcommisionperorder'])->name('vendors.deletevendorcommisionperorder');

    Route::post('categorycommisonlist', [CommisionController::class, 'vendorcommisioncategorylist'])->name('vendors.vendorcommisioncategorylist');

    Route::post('vendorcommisionproductlist', [CommisionController::class, 'vendorcommisionproductlist'])->name('vendors.vendorcommisionproductlist');

    Route::post('vendorcommisionperorderlist', [CommisionController::class, 'vendorcommisionperorderlist'])->name('vendors.vendorcommisionperorderlist');

    Route::get('orders', [VendorOrderManagmentController::class, 'orderlist'])->name('vendors.orderlist');

    Route::post('userorderdetails', [VendorOrderManagmentController::class, 'userorderdetails'])->name('vendors.userorderdetails');

    Route::post('order-status-change', [VendorOrderManagmentController::class, 'orderstatuschange'])->name('vendors.orderstatuschange');

    Route::post('order-sendordershipment', [VendorOrderManagmentController::class, 'pushOderToShipment'])->name('vendors.sendordershipment');

});