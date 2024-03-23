<?php

use Illuminate\Support\Facades\Route;
/* Admin */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;

/* FrontEnd */
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\BlogClientController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/* FrontEnd */
Route::get('/Frontend/home',[HomeController::class,'index']); 


//Register
Route::get('/Frontend/Register',[RegisterController::class,'index']);
Route::post('/Frontend/Register',[RegisterController::class,'register'])->name('Frontend.Register');

//Login
Route::get('/Frontend/Login',[LoginController::class,'index']);
Route::post('/Frontend/Login',[LoginController::class,'login'])->name('Frontend.login');

//Logout
Route::get('/Frontend/Logout',[LoginController::class,'logout'])->name('Frontend.logout');

#//Blog list
Route::get('/Frontend/BlogList',[BlogClientController::class,'index']);

#//Blog detail
Route::get('/Frontend/BlogSingle/{id}',[BlogClientController::class,'single']);

#// Blog rate
Route::post('/Frontend/BlogSingle/rate',[BlogClientController::class,'rate'])->name('BlogsingleRate');

#// Blog comment
Route::get('/Frontend/BlogSingle/comments',[BlogClientController::class,'single']);
Route::post('/Frontend/BlogSingle/comments',[BlogClientController::class,'comment'])->name('comments');

//# Account
Route::get('/Frontend/Members/account',[AccountController::class,'index']);
Route::post('/Frontend/Members/account',[AccountController::class,'update'])->name('membersUpsates');

##/Product
Route::get('/Frontend/Client/Product',[ProductController::class,'index']);

Route::get('/Frontend/Client/Product/add',[ProductController::class,'create']);
Route::post('/Frontend/Client/Product/add',[ProductController::class,'store'])->name('Product.add');

Route::get('/Frontend/Client/Product/edit/{id}',[ProductController::class,'edit']);
Route::post('/Frontend/Client/Product/edit/{id}',[ProductController::class,'update'])
->name('Product.update');

Route::get('/Frontend/Client/Product/delete/{id}',[ProductController::class,'destroy']);

##/Product Detail
Route::get('/Frontend/Client/Product/detail/{id}',[HomeController::class,'show']);

###/ Add to cart
Route::post('/Frontend/Product/Cart/quantity',[CartController::class,'changeProductQuantity'])->name('changeQty');
Route::post('/Frontend/Product/addToCart',[CartController::class,'add'])->name('addToCart');

Route::get('/Frontend/Product/Cart',[CartController::class,'index'])->name('Cart');

/**
 * Search
 */
Route::get('/Frontend/Search',[SearchController::class,'index'])->name('search');


/* Admin */
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home',[DashboardController::class,'index'])->name('home');

//Update Profile

Route::get('/Admin/profile',[UsersController::class,'index'])->name('Admin.profile');
Route::post('/Admin/profile',[UsersController::class,'update'])->name('Admin.update');

//Country
Route::get('/Admin/Country',[CountryController::class,'index'])->name('Admin.country');

Route::get('/Admin/Country/add',[CountryController::class,'create'])->name('Admin.country.add');
Route::post('/Admin/Country/add',[CountryController::class,'store'])->name('Admin.country.add.post');

Route::get('/Admin/Country/delete/{id}',[CountryController::class,'destroy']);

//Category
Route::get('/Admin/Category',[CategoryController::class,'index'])->name('Admin.category');

Route::get('/Admin/Category/add',[CategoryController::class,'create'])->name('Admin.category.add');
Route::post('/Admin/Category/add',[CategoryController::class,'store'])->name('Admin.category.add.post');

Route::get('/Admin/Category/delete/{id}',[CategoryController::class,'destroy']);

//Brand
Route::get('/Admin/Brand',[BrandController::class,'index'])->name('Admin.brand');

Route::get('/Admin/Brand/add',[BrandController::class,'create'])->name('Admin.brand.add');
Route::post('/Admin/Brand/add',[BrandController::class,'store'])->name('Admin.brand.add.post');

Route::get('/Admin/Brand/delete/{id}',[BrandController::class,'destroy']);

//Blog
Route::get('/Admin/Blog',[BlogController::class,'index'])->name('Admin.Blog');

Route::get('/Admin/Blog/add',[BlogController::class,'create'])->name('Admin.Blog.add');
Route::post('/Admin/Blog/add',[BlogController::class,'store'])->name('Admin.Blog.add.post');

Route::get('/Admin/Blog/update/{id}',[BlogController::class,'edit'])->name('Admin.Blog.edit');
Route::post('/Admin/Blog/update/{id}',[BlogController::class,'update'])->name('Admin.Blog.update');

Route::get('/Admin/Blog/delete/{id}',[BlogController::class,'destroy']);