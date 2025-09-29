<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\type;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);
Route::get('/category-products/{slug}/{id}', [FrontendController::class, 'categoryProducts']);
Route::get('/sub-category-products/{slug}/{id}', [FrontendController::class, 'subCategoryProducts']);
Route::get('/shop', [FrontendController::class, 'shopProducts']);
Route::get('/return-process', [FrontendController::class, 'returnProcess']);
Route::get('/product-details/{slug}', [FrontendController::class, 'productDetails']);
Route::get('/type-products/{type}', [FrontendController::class, 'typeProducts']);
Route::get('/view-cart', [FrontendController::class, 'viewCart']);
Route::get('/checkout', [FrontendController::class, 'checkOut']);

//Order Placing Process Routes :...................
Route::post('/confirm-order', [FrontendController::class, 'confirmOrder']);
Route::get('/success-order/{invoiceid}', [FrontendController::class, 'successOrder']);


// Add to Cart Routes ::-----
Route::post('/product-details/add-to-cart/{product_id}', [FrontendController::class, 'addToCartDetails']);
Route::get('/add-to-cart/{product_id}', [FrontendController::class, 'addToCart']);
Route::get('/add-to-cart/delete/{id}', [FrontendController::class, 'addToCartDelete']);

//privacy policy

Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy']);
Route::get('/terms-condition', [FrontendController::class, 'termsCondition']);
Route::get('/refund-policy', [FrontendController::class, 'refundPolicy']);
Route::get('/payment-policy', [FrontendController::class, 'paymentPolicy']);
Route::get('/about-us', [FrontendController::class, 'aboutUs']);
Route::get('/contact-us', [FrontendController::class, 'contactUs']);
Route::get('/blog-page', [FrontendController::class, 'blogPage']);
Route::get('/careers', [FrontendController::class, 'careEr']);

//admin/auth......
Route::get('/admin/login', [AdminAuthController::class, 'adminLogin']);
Route::get('/admin/logout', [AdminAuthController::class, 'logOut']);

Auth::routes();

Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);

//categories routes......
Route::get('/admin/category/create', [CategoryController::class, 'createCategory']);
Route::post('/admin/category/create/save', [CategoryController::class, 'categorySave']);
Route::get('/admin/category/create/list', [CategoryController::class, 'categoryList']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'categoryDelete']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'categoryEdit']);
Route::post('/admin/category/update/{id}', [CategoryController::class, 'categoryUpdate']);

//sub-categories routes.......
Route::get('admin/sub-category/create', [SubCategoryController::class, ('createSubCategory')]);
Route::post('/admin/sub-category/create/save', [SubCategoryController::class, 'subCategorySave']);
Route::get('/admin/sub-category/create/list', [SubCategoryController::class, 'subCategoryList']);
Route::get('/admin/sub-category/create/delete/{id}', [SubCategoryController::class, 'subCategoryDelete']);
Route::get('/admin/sub-category/create/edit/{id}', [SubCategoryController::class, 'subCategoryEdit']);
Route::post('/admin/sub-category/create/update/{id}', [SubCategoryController::class, 'subCategoryUpdate']);


//products routes................
Route::get('admin/product/create', [ProductController::class, ('productCategory')]);
Route::post('/admin/product/create/save', [ProductController::class, 'productSave']);
Route::get('/admin/product/create/list', [ProductController::class, 'productList']);
Route::get('/admin/product/create/delete/{id}', [ProductController::class, 'productDelete']);
Route::get('/admin/product/create/edit/{id}', [ProductController::class, 'productEdit']);
Route::post('/admin/product/create/update/{id}', [ProductController::class, 'productUpdate']);
Route::get('/admin/product/color/delete/{id}', [ProductController::class, 'colorDelete']);
Route::get('/admin/product/size/delete/{id}', [ProductController::class, 'sizeDelete']);
Route::get('/admin/product/gallery-image/delete/{id}', [ProductController::class, 'galleryImageDelete']);
Route::get('/admin/product/gallery-image/edit/{id}', [ProductController::class, 'galleryImageEdit']);
Route::post('/admin/product/gallery-image/update/{id}', [ProductController::class, 'galleryImageUpdate']);

