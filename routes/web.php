<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\products;
use App\Models\categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        $categories = categories::all();
        return view('welcome', compact('categories'));
    });

    Route::get('/dashboard', function () {
        return view('pages.index');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->name('user.')->prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/update', [UserController::class, 'update'])->name('update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::delete('/destroy', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/about', [UserController::class, 'about'])->name('about');
    Route::get('/shop', [ProductsController::class, 'index'])->name('shop');
    Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('product');
    Route::get('/single-product/{products}', [ProductsController::class, 'show'])->name('single-product');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/Create', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'createCheckout'])->name('checkout.store');
    Route::get('/order', [CheckoutController::class, 'order'])->name('order');
    Route::delete('/checkout/{id}', [CheckoutController::class, 'deleteCheckout'])->name('checkout.delete');
    Route::get('/fawry', [PaymentController::class, 'pay'])->name('fawry.payment');
    Route::get('/success', [PaymentController::class, 'success'])->name('fawry.success');
    Route::post('/store/comment', [CommentController::class, 'store'])->name('store.comment');
});
Route::view('/admin/login/show', 'admin.login')->name('admin.login.show');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');


Route::middleware(AdminMiddleware::class)->prefix('/admin')->name('admin.')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/', [AdminController::class, 'index'])->name('index');
    //---------------------------------Categories-------------------------------------
    Route::get('/Categories/Show', [AdminController::class, 'ShowCategories'])->name('ShowCategories');
    Route::get('/Categories/edit/{categories}', [AdminController::class, 'EditCategory'])->name('EditCategory');
    Route::post('/Categories/update/{categories}', [AdminController::class, 'updateCategory'])->name('updateCategory');
    Route::delete('/Categories/delete/{categories}', [AdminController::class, 'DeleteCategory'])->name('DeleteCategory');
    Route::post('StoreCategory', [CategoriesController::class, 'store'])->name('StoreCategory');
    Route::get('/CreateCategory', [CategoriesController::class, 'create'])->name('CreateCategory');
    //---------------------------------products-------------------------------------
    Route::get('/Product/Show', [AdminController::class, 'ShowProduct'])->name('ShowProduct');
    Route::get('/product/edit/{products}', [AdminController::class, 'EditProduct'])->name('EditProduct');
    Route::post('/product/update/{products}', [AdminController::class, 'updateProduct'])->name('updateProduct');
    Route::get('/CreateProducts', [ProductsController::class, 'create'])->name('CreateProducts');
    Route::post('/StoreProducts', [ProductsController::class, 'store'])->name('StoreProduct');
    Route::delete('/product/delete/{products}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
    //---------------------------------Orders-------------------------------------
    Route::get('/Orders/Show', [AdminController::class, 'Order'])->name('ShowOrders');
    Route::put('/Orders/markShipped/{checkout}', [AdminController::class, 'markShipped'])->name('markShipped');
    Route::put('/Orders/markdelivered/{checkout}', [AdminController::class, 'markdelivered'])->name('markdelivered');
    Route::delete('/checkout/{id}', [AdminController::class, 'deleteCheckout'])->name('checkout.delete');


});

require __DIR__ . '/auth.php';
