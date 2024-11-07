<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// Shop and Product Pages
Route::get('/shop', [ProductController::class, 'index'])->name('shop'); // View for displaying all products
Route::get('/api/products', [ProductController::class, 'indexApi'])->name('api.products'); // API endpoint for JSON
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Authentication Routes
Route::get('/register', [CustomerController::class, 'registerForm'])->name('register');
Route::post('/register', [CustomerController::class, 'register'])->name('register.submit');
Route::get('/login', [CustomerController::class, 'loginForm'])->name('login');
Route::post('/login', [CustomerController::class, 'login'])->name('login.submit');
Route::post('/logout', [CustomerController::class, 'logout'])->name('logout');

// Cart Routes
Route::get('/cart', [OrderController::class, 'showCart'])->name('cart');
Route::post('/cart/add/{product_id}', [OrderController::class, 'addToCart']);
Route::post('/cart/increase/{product_id}', [OrderController::class, 'increaseQuantity']);
Route::post('/cart/decrease/{product_id}', [OrderController::class, 'decreaseQuantity']);
Route::post('/cart/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');


Route::get('/user-cart', [OrderItemController::class, 'userCart'])->name('user.cart');

// Route to get a specific product by ID
Route::get('/api/products/{id}', [ProductController::class, 'getProductById']);

// Route for emails
Route::post('/contact', [ContactController::class, 'sendContactForm'])->name('contact.send');



// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(['is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Show form to create a product
    Route::get('/admin/products/create', [AdminController::class, 'showCreateProductForm'])->name('admin.products.create');
    // Handle product creation
    Route::post('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.store');

    Route::get('/admin/products/update', [AdminController::class, 'showUpdateProductForm'])->name('admin.products.update');
    Route::post('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.updateProduct');

    // Route to delete a product
    Route::delete('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Order routes in the admin section
    Route::get('admin/orders', [AdminController::class, 'listOrders'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [AdminController::class, 'showOrderDetails'])->name('admin.orders.show');
    Route::post('admin/orders/{order}/update', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');

    Route::get('/admin/customers', [AdminController::class, 'listCustomers'])->name('admin.customers.index');
    Route::get('/admin/customers/{id}', [AdminController::class, 'showCustomerDetails'])->name('admin.customers.show');
});
