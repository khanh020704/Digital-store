<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\User\UserController as FrontendUserController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\BlogController as FrontendBlogController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\MailController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\FilterController;

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');


/// ================== AUTH (LOGIN / REGISTER) ==================

Route::get('/members/login', [MemberController::class, 'showLoginForm'])->name('members.login');
Route::post('/members/login', [MemberController::class, 'login'])->name('members.login.submit');
Route::post('/members/logout', [MemberController::class, 'logout'])->name('members.logout');
Route::get('/members/register', [MemberController::class, 'showRegistrationForm'])->name('members.register');
Route::post('/members/register', [MemberController::class, 'register'])->name('members.register.submit');


/// ================== BLOG ==================
Route::get('/blog', [FrontendBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [FrontendBlogController::class, 'show'])->name('blog.show');
Route::post('/blog/rate/ajax', [FrontendBlogController::class, 'rateAjax'])->name('blog.rate.ajax');
Route::post('/blog/comment', [CommentController::class, 'store'])->name('blog.comment');
Route::get('/account/product/{id}', [ProductController::class, 'detail'])->name('account.details');

/// ================== SEARCH ==================
Route::get('/search', [ProductController::class, 'search'])->name('search.product');
Route::get('/search/advanced', [SearchController::class, 'index'])->name('search.advanced');
Route::get('/search/price', [FilterController::class, 'filterPrice']);


/// ================== USER (LEVEL = 0) ==================
Route::group(['middleware'=>['web', 'member']],function () {
    Route::get('/account/update', [FrontendUserController::class, 'edit'])->name('account.update');
    Route::post('/account/update', [FrontendUserController::class, 'update'])->name('account.update.submit');
    Route::get('/account/add-product', [ProductController::class, 'create'])->name('account.add-product');
    Route::post('/account/add-product', [ProductController::class, 'store'])->name('account.add-product.submit');
    Route::get('/account/products', [ProductController::class, 'index'])->name('account.products');
    Route::get('/account/edit-product/{id}', [ProductController::class, 'edit'])->name('account.edit-product');
    Route::post('/account/edit-product/{id}', [ProductController::class, 'update'])->name('account.edit-product.submit');
    Route::delete('/account/delete-product/{id}', [ProductController::class, 'delete'])->name('account.delete-product');
    Route::get('/account/cart', [CartController::class, 'index'])->name('frontend.account.cart');
    Route::post('/account/cartadd', [CartController::class, 'add']);
    Route::post('/cart/update', [CartController::class, 'update']);
    Route::post('/cart/delete', [CartController::class, 'delete']);
    Route::get('/checkout', [MailController::class, 'showCheckout'])
    ->name('checkout.page');
    Route::post('/checkout/order', [MailController::class, 'order'])->name('checkout.order');

});

Route::group(['middleware' => ['web', 'admin']], function () {
    
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
    Route::get('/admin/user/profile', [UserController::class, 'index'])->name('admin.user.profile');
    Route::post('/admin/user/profile/update', [UserController::class, 'update'])->name('admin.user.profile.update');
    Route::get('/admin/country', [CountryController::class, 'index'])->name('admin.country.index');
    Route::get('/admin/country/addcountry', [CountryController::class, 'add'])->name('admin.country.add');
    Route::post('/admin/country/store', [CountryController::class, 'store'])->name('admin.country.store');
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/admin/blog/addblog', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/admin/blog/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/delete/{id}', [BlogController::class, 'delete'])->name('admin.blog.delete');


    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/admin/category/add', [CategoryController::class, 'add'])->name('admin.category.add');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');

    Route::get('/admin/brand', [BrandController::class, 'index'])->name('admin.brand.index');
    Route::get('/admin/brand/add', [BrandController::class, 'add'])->name('admin.brand.add');
    Route::post('/admin/brand/store', [BrandController::class, 'store'])->name('admin.brand.store');

});

  Route::get('/admin/user/form-basic', function () {
    return view('admin.user.form-basic');
    
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');