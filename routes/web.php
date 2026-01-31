<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Route::get('/product', function () {
//     return view('product');
// });
// Route::get('/product/create', function () {
//     return view('create');
// });
// Route::get('product/edit', function () {
//     return view('edit');
// });
// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/regester', function () {
//     return view('regester');
// });

//Route Refix
Route::prefix('admin')->group(function () {
        // Auth Routes
    Route::get('/',[AuthController::class, 'showLogin'])->name('auth.show.login');
    Route::post('/login/process', [AuthController::class, 'ProcessLogin'])->name('auth.login.process');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.show.register');
    Route::post('/register/process', [AuthController::class, 'ProcessRegister'])->name('auth.register.process');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    //Route with Controller
    Route::get('/product',[ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/store',[ProductController::class, 'store'])->name('product.store');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product{id}', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/deleteSelect', [ProductController::class, 'deleteSelect'])->name('product.deleteSelect');
});

// // Auth Routes
// Route::get('/login',[AuthController::class, 'showLogin'])->name('auth.show.login');
// Route::post('/login/process', [AuthController::class, 'ProcessLogin'])->name('auth.login.process');
// Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.show.register');
// Route::post('/register/process', [AuthController::class, 'ProcessRegister'])->name('auth.register.process');

// Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// //Route with Controller
// Route::get('/product',[ProductController::class, 'index'])->name('product.index');
// Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
// Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
// Route::post('/product/store',[ProductController::class, 'store'])->name('product.store');
// Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::get('/product{id}', [ProductController::class, 'delete'])->name('product.delete');
// Route::post('/product/deleteSelect', [ProductController::class, 'deleteSelect'])->name('product.deleteSelect');

