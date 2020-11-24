<?php

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Visit;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// if(!isset($_COOKIE['visit'])){
//     setcookie('visit', 'true', time()+(60*60*24*30));
//     Visit::create(['visit'=>'1']);
// }
// Admin Routes
Route::view('test', 'test');
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
    Route::get('/', 'Admin\AdminController@dashboard')->name('admin.dashboard');
    Route::match(['get', 'post'],'change/password', 'Admin\AdminController@changePassword')->name('admin.change.password');
    Route::get('logout', 'Admin\AdminController@adminLogOut')->name('admin.logout');
    Route::get('change/user/status/{id}', 'Admin\AdminController@changeUserStatus')->name('admin.change.user.status');
    Route::get('show/users', 'Admin\AdminController@showUsers')->name('admin.show.users');
    //ProductController
    Route::match(['get', 'post'], 'add/product','Admin\ProductController@addProduct')->name('admin.add.product');
    Route::match(['get', 'post'], 'edit/product', 'Admin\ProductController@editProduct')->name('admin.edit.product');
    Route::get('delete/product', 'Admin\ProductController@deleteProduct')->name('admin.delete.product');


    //ProductTypeController
    Route::match(['get', 'post'], 'add/product/type', 'Admin\ProductTypeController@addProductType')->name('admin.product.type');
    Route::match(['get', 'post'], 'edit/product/type', 'Admin\ProductTypeController@editProductType')->name('admin.edit.product.type');
    Route::get('delete/product/type', 'Admin\ProductTypeController@deleteProductType')->name('admin.delete.product.type');
    Route::get('get/product/types', 'Admin\ProductTypeController@getProductType')->name('admin.get.product.type');


    //ProductBrandController
    Route::get('delete/product/brand', 'Admin\ProductBrandController@deleteProductBrand')->name('admin.delete.product.brand');
    Route::get('get/product/brands', 'Admin\ProductBrandController@getProductBrand')->name('admin.get.product.brand');
    Route::match(['get', 'post'], 'add/product/brand', 'Admin\ProductBrandController@addProductBrand')->name('admin.product.brand');
    Route::match(['get', 'post'], 'edit/product/brand', 'Admin\ProductBrandController@editProductBrand')->name('admin.edit.product.brand');


    // ItemTypeController
    Route::match(['get', 'post'], 'add/product/itemtype', 'Admin\ItemTypeController@addItemType')->name('admin.product.itemtype');
    Route::match(['get', 'post'], 'edit/product/itemtype', 'Admin\ItemTypeController@editItemType')->name('admin.edit.product.itemtype');
    Route::get('delete/itemtype', 'Admin\ItemTypeController@deleteItemtype')->name('admin.delete.itemtype');
    Route::get('get/product/itemtype', 'Admin\ItemTypeController@getItemType')->name('admin.get.product.itemtype');   


    // ItemController
    Route::get('show/items', 'Admin\ItemController@index')->name('admin.show.items');
    Route::get('delete/item', 'Admin\ItemController@deleteItem')->name('admin.delete.item');

    Route::match(['get', 'post'], 'add/item', 'Admin\ItemController@addItem')->name('admin.add.item');
    Route::match(['get', 'post'], 'edit/item', 'Admin\ItemController@editItem')->name('admin.edit.item');


    // BannerController
    Route::get('upload/banner', 'Admin\BannerController@addBanner')->name('admin.upload.banner');
    Route::post('upload/banner', 'Admin\BannerController@uploadBanner')->name('admin.upload.banner');
    Route::get('show/banners', 'Admin\BannerController@showBanners')->name('admin.show.banners');
    Route::get('delete/banner', 'Admin\BannerController@deleteBanner')->name('admin.delete.banner');

    // SmallannerController
    Route::get('upload/small/banner', 'Admin\BannerController@addSmallBanner')->name('admin.upload.small.banner');
    Route::post('upload/small/banner', 'Admin\BannerController@uploadSmallBanner')->name('admin.upload.small.banner');
    Route::get('show/small/banners', 'Admin\BannerController@showSmallBanners')->name('admin.show.small.banners');
    Route::get('delete/small/banner', 'Admin\BannerController@deleteSmallBanner')->name('admin.delete.small.banner');


    // GalleryController
    Route::post('admin/upload/gallery/image', 'GalleryController@uploadImage')->name('admin.upload.gallery.image');
    Route::get('admin/delete/gallery/image/{id}', 'GalleryController@deleteGalleryImage')->name('admin.delete.gallery.image');
    Route::get('upload', 'GalleryController@index')->name('admin.show.gallery');


    // SiteSettingController
    Route::get('site/setting', 'Admin\SiteSettingController@index')->name('admin.site.setting');
    Route::post('save/site/setting', 'Admin\SiteSettingController@save')->name('admin.save.site.setting');


    // ContactUsController
    Route::post('save/contact/us', 'Admin\ContactUsController@save')->name('admin.save.contact.us');
    Route::get('contact/us', 'Admin\ContactUsController@index')->name('admin.contact.us');


    // AboutUsController
    Route::post('save/about/us', 'Admin\AboutUsController@save')->name('admin.save.about.us');
    Route::get('about/us', 'Admin\AboutUsController@index')->name('admin.about.us');


    // OurPartnersController
    Route::get('our/partners', 'Admin\OurPartnersController@deleteProduct')->name('admin.our.partners');

    // ArrivalController
    Route::get('edit/featured/arrival', 'FeaturedArrivalController@editFeaturedArrival')->name('admin.edit.featured.arrival');
    Route::get('edit/special/arrival', 'SpecialArrivalController@editSpecialArrival')->name('admin.edit.special.arrival');

    // Top Selling Controllers
    Route::get('edit/top/selling/week', 'TopSellingWeekController@editTopSellingWeek')->name('admin.edit.top.selling.week');
    Route::get('edit/top/selling/month', 'TopSellingMonthController@editTopSellingMonth')->name('admin.edit.top.selling.month');

    Route::get('show/service/banner', 'Admin\ServiceBannerController@show')->name('admin.show.service.banner');
    Route::get('delete/service/banner', 'Admin\ServiceBannerController@delete')->name('admin.delete.service.banner');
    Route::match(['get', 'post'], 'add/service/banner', 'Admin\ServiceBannerController@add')->name('admin.add.service.banner');
    Route::match(['get', 'post'], 'edit/service/banner', 'Admin\ServiceBannerController@edit')->name('admin.edit.service.banner');

    // ColorController
    Route::post('add/item/variant', 'Admin\ItemController@addItemVariant')->name('admin.add.item.variant');

    
    Route::get('show/delivery/process', 'Admin\DeliveryProcessController@showDeliveryProcess')->name('admin.show.delivery.process');
    Route::match(['get', 'post'], 'edit/delivery/process', 'Admin\DeliveryProcessController@editDeliveryProcess')->name('admin.edit.delivery.process');
    Route::get('delete/delivery/process', 'Admin\DeliveryProcessController@deleteDeliveryProcess')->name('admin.delete.delivery.process');
    Route::post('add/delivery/process', 'Admin\DeliveryProcessController@addDeliveryProcess')->name('admin.add.delivery.process');
    Route::get('item/delivered', 'Admin\DeliveryProcessController@itemDelivered')->name('admin.item.delivered');
    Route::get('item/pending', 'Admin\DeliveryProcessController@itemPending')->name('admin.item.pending');
    Route::get('show/invoice/{id}', 'Admin\DeliveryProcessController@showInvoice')->name('show.invoice');


    Route::get('admin/show/payments', function () {
        $payments = \App\Models\Payment::all();
        return view('admin.orderManage.payments', compact('payments'))
        ->render();
    })->name('admin.show.payments');

});
// User Routes
Route::group(['middleware' => ['auth']], function() {
    Route::get('cart', 'CartController@showCart')->name('show.cart');
    Route::post('addtocart', 'CartController@addToCart')->name('addtocart');
    Route::post('addToWishList', 'WishlistController@addToWishList')->name('addToWishList');
    Route::post('create-payment-card', 'OrderController@chargeWithCard')->name('create-payment-card');
    Route::get('remove/from/cart', 'CartController@removeFromCart')->name('remove.from.cart');
    Route::get('change/cart/item/quantity', 'CartController@changeCartItemQuantity')->name('change.cart.item.quantity');
    Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('edit/profile', 'UserController@editProfile')->name('edit.profile');
    Route::get('purchase/history', 'UserController@purchaseHistory')->name('purchase.history');
    Route::get('wishlist', 'UserController@wishlist')->name('wishlist');
    Route::post('update/profile', 'UserController@updateProfile')->name('update.profile');
    Route::post('update/password', 'UserController@updatePassword')->name('update.password');
    Route::post('update/info', 'UserController@updateInfo')->name('update.info');
    Route::get('remove/from/wishlist', 'WishlistController@removeFromWishlist')->name('remove.from.wishlist');
});
Auth::routes();

// guest and user routes
Route::get('/', 'UserController@index')->name('home');
Route::get('aboutus', 'UserController@aboutUs')->name('about.us');
Route::get('product/{product}/{brand}/{slug}/{id}', 'ProductController@showProduct')->name('show.product');
Route::get('products/{product}/{slug}/{id}', 'ProductController@showProducts')->name('show.products');
Route::get('all/{name}/{id}', 'ProductController@showProductsWithProductName')->name('show.products.with.product.name');
Route::post('get/filtered/products', 'ProductController@getFilteredProducts')->name('get.filtered.products');
Route::post('get/products/search', 'ProductController@getSearchedProducts')->name('get.searched.products');
Route::post('get/filtered/brand/products', 'ProductController@getFilteredBrandProducts')->name('get.filtered.brand.products');
Route::post('get/filtered/itemtype', 'ProductController@getFilteredItemtype')->name('get.filtered.itemtype');
Route::get('admin/login', 'Admin\AdminController@login')->name('admin.login');
Route::get('terms/and/condition', 'UserController@terms')->name('terms.and.condition');

Route::post('payment-method', 'CartController@paymentMethods')->name('payment.method');
Route::get('delivery-method', 'CartController@deliveryMethods')->name('delivery.methods');
Route::get('paymentConfirmed', 'CartController@paymentConfirmed')->name('payment.confirmed');

Route::get('load/itemtypes', 'ItemTypeController@load')->name('load.item_types');


// paypal routes

Route::post('create-payment', 'OrderController@create')->name('create-payment');
Route::get('execute-payment', 'OrderController@execute')->name('execute-payment');

Route::get('show-invoice', function () {
    return view('admin.orderManage.invoice');
})->name('admin.show.invoice');


Route::get('admin/delete/item/image', 'Admin\ItemController@deleteItemImage')->name('admin.delete.item.image');
Route::get('admin/delete/item/variant', 'Admin\ItemController@deleteItemVariant')->name('admin.delete.item.variant');

Route::get('privacy/policy', function () {
    $products = Product::all();
    $contactus = ContactUs::first();
    return view('user.privacyPolicy', compact('contactus', 'products'));
})->name('privacy.policy');
Route::get('contactus', function () {
    $products = Product::all();
    $contactus = ContactUs::first();
    return view('user.contactus', compact('contactus', 'products'));
})->name('contactus');


Route::get('get/product/variant/price', 'ProductController@getPrice')->name('get.product.variant.price');


Route::get('user/show/invoice/{id}', function($id){
    $order = \App\Models\Payment::where('id',$id)->where('user_id',auth()->user()->id)->first();
    return view('admin.orderManage.invoice', compact('order'))
    ->render();
})->name('user.show.invoice');


Route::get('get/cities', 'UserController@getCities')->name('get.cities');
Route::post('contactus', 'UserController@userContact')->name('user.contact');
