<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', UserMiddleware::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/index' , [HomeController::class, 'index'])->name('index');
Route::get('/about' , [AboutController::class, 'index'])->name('about');
Route::get('/shop' , [ShopController::class, 'index'])->name('shop');
Route::get('/contact' , [ContactController::class, 'index'])->name('contact');
Route::post('/contact' , [ContactController::class, 'store'])->name('store-contact');
Route::get('/cart' , [CartController::class, 'index'])->name('cart');
Route::get('/checkout' , [CheckoutController::class, 'index'])->name('checkout');
Route::get('/blog' , [BlogController::class, 'index'])->name('blog');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(GuestMiddleware::class)->group(function(){
        Route::get('/login' , [AdminLoginController::class, 'index']);
        Route::post('/login' , [AdminLoginController::class, 'login'])->name('login');
    });
    Route::middleware(['auth', AdminMiddleware::class])->group(function(){
        Route::get('/dashboard' , [AdminLoginController::class, 'dashboard'])->name('dashboard');
        Route::get('/index', [HomeController::class, 'dashboard']);
        Route::get('/logout' , [AdminLoginController::class, 'logout'])->name('logout');

        ///Blog Routes

        Route::get('/show-blog' , [BlogController::class, 'show'])->name('show-blog');
        Route::get('/write-blog' , [BlogController::class, 'write'])->name('write');
        Route::post('/write-blog' , [BlogController::class, 'store'])->name('write-blog');

        // Category Routes

        Route::get('/add-category' , [CategoryController::class, 'create'])->name('add-category');
        Route::post('/add-category' , [CategoryController::class, 'store'])->name('add-cat');
        Route::get('/show-category' , [CategoryController::class, 'show'])->name('show-cat');
        Route::get('getSlug' , function(Request $request){
            if(!empty($request->topic)){
                $slug = '';
                $slug = Str::slug($request->topic);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug,
            ]);
        })->name('getSlug');

        // SubCategory Routes

        Route::get('/add-sub-cat' , [SubCategoryController::class, 'create'])->name('add-subcat');
        Route::post('/add-sub-cat' , [SubCategoryController::class, 'store'])->name('add-sub-cat');
        Route::get('/show-sub-cat' , [SubCategoryController::class, 'show'])->name('show-subcat');
        Route::get('/product-subcategory' , [ProductSubCategoryController::class, 'index'])->name('product-subcat');

        // Brand Routes

        Route::get('/add-brand' , [BrandController::class, 'create'])->name('brand');
        Route::post('/add-brand' , [BrandController::class, 'store'])->name('add-brand');
        Route::get('/show-brand' , [BrandController::class, 'show'])->name('show-brand');

        // Attribute Routes

        Route::get('/add-attribute' , [AttributeController::class, 'create'])->name('attribute');
        Route::post('/add-attribute' , [AttributeController::class, 'store'])->name('add-attribute');

        // Attribute-Value Routes

        Route::get('/add-att-value' , [AttributeValueController::class, 'create'])->name('att-value');
        Route::post('/add-att-value' , [AttributeValueController::class, 'store'])->name('add-att-value');
        Route::get('/show-value' , [AttributeValueController::class, 'show'])->name('show-value');
        Route::get('/product-attribute' , [ProductAttributeController::class, 'index'])->name('product-value');

        // Contact Routes

        Route::get('/show-contact' , [ContactController::class, 'show'])->name('show-contact');
        Route::get('/show-contact' , [ContactController::class, 'show'])->name('show-contact');



        // Product Routes

        Route::get('/add-product' , [ProductController::class, 'create'])->name('product');
        Route::post('/add-product' , [ProductController::class, 'store'])->name('add-product');
        Route::get('/show-product' , [ProductController::class, 'show'])->name('show-product');
    });

});

// Route::get('/admin/dashboard', [HomeController::class, 'dashboard']);
