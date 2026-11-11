<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\BlogController as FrontBlogController;
use App\Http\Controllers\Frontend\FaqController as FrontFaqController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\ConsultationController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\QuoteController;

// Admin Controllers
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangepasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FinishController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WoodController;
use App\Http\Controllers\QuotationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter.subscribe');
Route::post('/newsletter-submit', [HomeController::class, 'newsletter'])->name('newsletter.submit');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/faqs', [FrontFaqController::class, 'index'])->name('faqs');
Route::get('/faq', function () {
    return redirect()->route('faqs');
});

Route::get('/custom-enquiry', [ConsultationController::class, 'index'])->name('custom-enquiry');
Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation');
Route::post('/consultation-submit', [ConsultationController::class, 'submit'])->name('consultation.submit');
Route::post('/consultation', [ConsultationController::class, 'submit']);

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/contact', [ContactController::class, 'submit']);

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout-submit', [CheckoutController::class, 'submit'])->name('checkout.submit');
Route::post('/inquiry-submit', [CheckoutController::class, 'submit'])->name('inquiry.submit');

// Quote & Cart AJAX Routes
Route::get('/quote/items', [QuoteController::class, 'items'])->name('quote.items');
Route::post('/quote/add', [QuoteController::class, 'add'])->name('quote.add');
Route::post('/quote/update', [QuoteController::class, 'update'])->name('quote.update');
Route::post('/quote/remove', [QuoteController::class, 'remove'])->name('quote.remove');
Route::post('/quote/clear', [QuoteController::class, 'clear'])->name('quote.clear');

// Compatible Aliases for Cart & API
Route::get('/cart/items', [QuoteController::class, 'items'])->name('cart.items');
Route::post('/cart/add', [QuoteController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [QuoteController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [QuoteController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [QuoteController::class, 'clear'])->name('cart.clear');
Route::get('/api/quote/items', [QuoteController::class, 'items']);
Route::post('/api/quote/add', [QuoteController::class, 'add']);

// Search Autocomplete Route
Route::get('/search/autocomplete', [ShopController::class, 'autocomplete'])->name('search.autocomplete');
Route::get('/api/search/autocomplete', [ShopController::class, 'autocomplete']);

// Shop Pages
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// SEO-Friendly Category Route (using slug)
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('category.show');
Route::get('/category/{category}/{subcategory}', function ($category, $subcategory) {
    return redirect()->route('category.show', ['slug' => $category], 301);
});
Route::get('/categories', function () {
    return redirect()->route('shop', [], 301);
});

// Legacy / admin alias for category products route
Route::get('/category/{category?}', function ($category = null) {
    if (!$category) {
        return redirect()->route('shop');
    }
    return redirect()->route('category.show', ['slug' => $category]);
})->name('product');

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/rooms', [ShopController::class, 'rooms'])->name('rooms');
    Route::get('/complete-room', [ShopController::class, 'completeRoom'])->name('complete-room');
    Route::get('/editorial', [ShopController::class, 'editorial'])->name('editorial');
    Route::get('/materials', [ShopController::class, 'materials'])->name('materials');
    Route::get('/product/{slug?}', [ShopController::class, 'product'])->name('product');
});

// Primary SEO-Friendly Product Route (using slug)
Route::get('/product/{slug?}', [ShopController::class, 'product'])->name('product.single');
Route::get('/product-details/{slug?}', [ShopController::class, 'product'])->name('productdetail');
Route::get('/product-detail/{slug?}', [ShopController::class, 'product'])->name('product.detail');

// Primary SEO-Friendly Blog Routes (using slug)
Route::get('/blog', [FrontBlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [FrontBlogController::class, 'post'])->name('blog.single');
Route::get('/blog/post/{slug?}', [FrontBlogController::class, 'post'])->name('blog.post');

// Primary SEO-Friendly Dynamic CMS Page Routes (using slug)
Route::get('/page/{slug}', [AboutController::class, 'show'])->name('page.show');
Route::get('/terms-of-use', function () {
    return redirect()->route('page.show', 'terms-of-use', 301);
});
Route::get('/privacy-policy', function () {
    return redirect()->route('page.show', 'privacy-policy', 301);
});

// Aliases for slug-less or dashed URLs
Route::get('/product-single', function (Request $request) {
    return redirect()->route('product.single', $request->query());
});
Route::get('/shop-rooms', function (Request $request) {
    return redirect()->route('shop.rooms', $request->query());
});
Route::get('/shop-complete-room', function (Request $request) {
    return redirect()->route('shop.complete-room', $request->query());
});
Route::get('/shop-editorial', function (Request $request) {
    return redirect()->route('shop.editorial', $request->query());
});
Route::get('/shop-materials', function (Request $request) {
    return redirect()->route('shop.materials', $request->query());
});
Route::get('/blog-post', function (Request $request) {
    return redirect()->route('blog.post', $request->query());
});

// Static HTML Redirects (preserves all query strings such as ?id=... or ?wishlist=true)
Route::get('/index.html', function (Request $request) {
    return redirect()->route('home', $request->query());
});
Route::get('/about.html', function (Request $request) {
    return redirect()->route('about', $request->query());
});
Route::get('/shop.html', function (Request $request) {
    return redirect()->route('shop', $request->query());
});
Route::get('/shop-rooms.html', function (Request $request) {
    return redirect()->route('shop.rooms', $request->query());
});
Route::get('/shop-complete-room.html', function (Request $request) {
    return redirect()->route('shop.complete-room', $request->query());
});
Route::get('/shop-editorial.html', function (Request $request) {
    return redirect()->route('shop.editorial', $request->query());
});
Route::get('/shop-materials.html', function (Request $request) {
    return redirect()->route('shop.materials', $request->query());
});
Route::get('/product-single.html', function (Request $request) {
    return redirect()->route('product.single', $request->query());
});
Route::get('/blog.html', function (Request $request) {
    return redirect()->route('blog', $request->query());
});
Route::get('/blog-post.html', function (Request $request) {
    return redirect()->route('blog.post', $request->query());
});
Route::get('/contact.html', function (Request $request) {
    return redirect()->route('contact', $request->query());
});
Route::get('/consultation.html', function (Request $request) {
    return redirect()->route('consultation', $request->query());
});
Route::get('/checkout.html', function (Request $request) {
    return redirect()->route('checkout', $request->query());
});
Route::get('/faq.html', function (Request $request) {
    return redirect()->route('faqs', $request->query());
});
Route::get('/faqs.html', function (Request $request) {
    return redirect()->route('faqs', $request->query());
});

/**
 * Backend Admin Routes
 */
Route::get('/clear-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Your cache has been cleared');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('changepassword', [ChangepasswordController::class, 'index'])->name('changepassword');
        Route::post('changepassword', [ChangepasswordController::class, 'update'])->name('changepassword.update');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::delete('blog/action/multi-delete', [BlogController::class, 'multiDelete'])->name('blog.multiDestroy');
        Route::delete('category/action/multi-delete', [CategoryController::class, 'multiDelete'])->name('category.multiDestroy');
        Route::delete('finish/action/multi-delete', [FinishController::class, 'multiDelete'])->name('finish.multiDestroy');
        Route::delete('wood/action/multi-delete', [WoodController::class, 'multiDelete'])->name('wood.multiDestroy');
        Route::delete('page/action/multi-delete', [PageController::class, 'multiDelete'])->name('page.multiDestroy');
        Route::delete('product/action/multi-delete', [ProductController::class, 'multiDelete'])->name('product.multiDestroy');
        Route::delete('product/gallery-image/{id}', [ProductController::class, 'deleteGalleryImage'])->name('product.deleteGalleryImage');
        Route::delete('slider/action/multi-delete', [SliderController::class, 'multiDelete'])->name('slider.multiDestroy');
        Route::delete('testimonial/action/multi-delete', [TestimonialController::class, 'multiDelete'])->name('testimonial.multiDestroy');
        Route::delete('faq/action/multi-delete', [FaqController::class, 'multiDelete'])->name('faq.multiDestroy');
        Route::delete('quotation/action/multi-delete', [QuotationController::class, 'multiDelete'])->name('quotation.multiDestroy');
        Route::get('quotation/{quotation}/print', [QuotationController::class, 'print'])->name('quotation.print');

        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::resources([
            'admin' => AdminController::class,
            'category' => CategoryController::class,
            'finish' => FinishController::class,
            'wood' => WoodController::class,
            'page' => PageController::class,
            'slider' => SliderController::class,
            'blog' => BlogController::class,
            'user' => UserController::class,
            'product' => ProductController::class,
            'testimonial' => TestimonialController::class,
            'newsletter' => NewsletterController::class,
            'site' => SiteController::class,
            'order' => OrderController::class,
            'faq' => FaqController::class,
            'quotation' => QuotationController::class,
        ]);
    });
});

// Aliases for admin
Route::get('/stage-admin', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/bharat-admin', function () {
    return redirect()->route('admin.dashboard');
});

