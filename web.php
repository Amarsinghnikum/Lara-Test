<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('index');
});

Route::match(['get','post'],'/save-index',[HomeController::class, 'Index']);
Route::match(['get','post'],'/loginUser',[HomeController::class, 'loginUser']);
Route::match(['get','post'],'/admin',[HomeController::class, 'admin']);

Route::get('/changepassword',[HomeController::class, 'changepassword']);
Route::post('/savechangepassword',[HomeController::class, 'savechangepassword']);

Route::get('/logout',[HomeController::class, 'Index']);
Route::get('/index',[HomeController::class, 'Index2']);

////////////////////////////////////////////////////////////////////////////////category
Route::match(['get','post'],'/add-category', [HomeController::class, 'Category']);
Route::post('/save-category', [HomeController::class, 'Category']);
Route::match(['get','post'],'/updatecategory', [HomeController::class, 'Updatecategorysave']);
Route::get('/delete-category/{id}', [HomeController::class,'Deletecategory']);
//////////////////////////////////////////////////////////////////////////////// subcategory

Route::match(['get','post'],'/add-sub-category', [HomeController::class, 'Subcategory']);
Route::post ('/save-subcategory', [HomeController::class, 'SaveSubcategory']);
Route::match(['get','post'],'/updatesubcategory', [HomeController::class, 'Updatesubcategorysave']);
Route::get('/delete-subcategory/{id}', [HomeController::class, 'Deletesubcategory']);
//////////////////////////////////////////////////////////////////////////////// subcategory

Route::match(['get','post'],'/product', [HomeController::class, 'Product']);

Route::post ('/save-product', [HomeController::class, 'SaveProduct']);
Route::match(['get','post'],'/updateproduct', [HomeController::class, 'Updateproductsave']);
Route::get('/delete-product/{id}', [HomeController::class, 'Deleteproduct']);

///////////////////////////////////////Start Edit Area

Route::get('/update-category/{id}', [HomeController::class, 'Updatecategory']);
Route::get('/update-subcategory/{id}', [HomeController::class, 'Updatesubcategory']);
Route::get('/update-product/{id}', [HomeController::class, 'Updateproduct']);

///////////////////////////////////////Ends Edit Area

Route::post('/deleteDescription', [HomeController::class, 'deleteDescriptionsss']);

Route::post('/deletePdf', [HomeController::class, 'deletePdfs']);

Route::post('/subCategoryResult', [HomeController::class, 'subCategoryResults']);
Route::post('/updatesubCategoryResult', [HomeController::class, 'updatesubCategoryResults']);

?>