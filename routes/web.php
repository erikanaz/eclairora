<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

use Kreait\Firebase\Factory;

Route::get('/test-firebase', function() {
    $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/serviceAccountKey.json'));
    $firestore = $factory->createFirestore()->database();
    return $firestore ? 'Connected to Firestore!' : 'Failed';
});

Route::prefix('customer')
    ->name('customer.')
    ->middleware(['auth', 'role:customer'])
    ->group(function () {

    // Dashboard Customer
    // Route::get('/dashboard', function () {
    //     return view('customer.dashboard');
    // })->name('dashboard');

    // Dashboard Customer dengan controller
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Optional: API untuk stats
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])
        ->name('dashboard.stats');

    // Produk
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/{id}', [ProductController::class, 'show'])
        ->name('products.show');

    // ===== KERANJANG - OPTION 1 =====
    // Untuk halaman cart (customer/cart)
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');  // customer.cart
        
    // Untuk AJAX operations
    Route::prefix('cart')->group(function () {
        Route::post('/add/{product}', [CartController::class, 'add'])
            ->name('cart.add');  // customer.cart.add
        
        Route::put('/update/{item}', [CartController::class, 'update'])
            ->name('cart.update');  // customer.cart.update
        
        Route::delete('/remove/{item}', [CartController::class, 'remove'])
            ->name('cart.remove');  // customer.cart.remove
        
        Route::delete('/clear', [CartController::class, 'clear'])
            ->name('cart.clear');  // customer.cart.clear
        
        Route::get('/count', [CartController::class, 'getCount'])
            ->name('cart.count');  // customer.cart.count
    });

    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::get('/checkout', [OrderController::class, 'checkout'])
        ->name('orders.checkout');

    Route::post('/checkout/process', [OrderController::class, 'process'])
        ->name('orders.process');
});


require __DIR__.'/auth.php';
