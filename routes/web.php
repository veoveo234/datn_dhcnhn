<?php

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

//* Route - Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Auth'], function () {
    Route::get('/login', [
        'as' => 'admin.login',
        'uses' => 'AuthAdminController@index',
    ]);

    Route::post('/login', [
        'as' => 'admin.checkLogin',
        'uses' => 'AuthAdminController@checkLogin',
    ]);

    Route::get('/register', [
        'as' => 'admin.register',
        'uses' => 'AuthAdminController@create',
    ]);

    Route::post('/register', [
        'as' => 'admin.register',
        'uses' => 'AuthAdminController@register',
    ]);

    Route::get('/logout', [
        'as' => 'admin.logout',
        'uses' => 'AuthAdminController@logout',
    ]);

});
Route::post('/product-search', 'Admin\Product\ProductController@search')->name('product.search');
Route::middleware(['loginAdmin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'Admin\Home\HomeController@index')->name('home.index');
        Route::get('/load-sales', 'Admin\Home\HomeController@loadSales')->name('home.revenue');
        Route::get('/load-overall', 'Admin\Home\HomeController@loadOverall')->name('home.overall');
        Route::get('/load-month-sale', 'Admin\Home\HomeController@loadMonthsale')->name('load.month.sale');

        Route::get('/brand', 'Admin\Product\BrandController@index')->name('brand.index');
        Route::post('/brand-insert', 'Admin\Product\BrandController@insert')->name('brand.insert');
        Route::get('/brand-edit', 'Admin\Product\BrandController@edit')->name('brand.edit');
        Route::post('/brand-update', 'Admin\Product\BrandController@update')->name('brand.update');
        Route::get('/brand-delete', 'Admin\Product\BrandController@destroy')->name('brand.delete');

        Route::get('/category', 'Admin\Product\CategoryController@index')->name('category.index');
        Route::post('/category-insert', 'Admin\Product\CategoryController@insert')->name('category.insert');
        Route::get('/category-edit', 'Admin\Product\CategoryController@edit')->name('category.edit');
        Route::post('/category-update', 'Admin\Product\CategoryController@update')->name('category.update');
        Route::get('/category-delete', 'Admin\Product\CategoryController@destroy')->name('category.delete');

        //* admin - product
        Route::get('/product', 'Admin\Product\ProductController@index')->name('product.index');
        Route::get('/view-add-product', 'Admin\Product\ProductController@viewAddNew')->name('product.view.add');
        Route::post('/product-store', 'Admin\Product\ProductController@store')->name('product.store');
        Route::get('/product-show', 'Admin\Product\ProductController@show')->name('product.show');
        Route::get('/product-edit/{id}', 'Admin\Product\ProductController@edit')->name('product.edit');
        Route::get('/product-edit', 'Admin\Product\ProductController@edit')->name('product.edit');
        Route::post('/product-update', 'Admin\Product\ProductController@update')->name('product.update');
        Route::get('/product-destroy', 'Admin\Product\ProductController@destroy')->name('product.destroy');
        

        Route::get('/profile/{id}', 'Admin\Profile\ProfileController@edit')->name('profile.edit');
        Route::post('/profile/{id}', 'Admin\Profile\ProfileController@update')->name('profile.update');

        Route::get('/statistical', 'Admin\Statistical\StatisticalController@index')->name('statistical.index');

        //CATEGORY_BLOG
        Route::group(['prefix' => 'category-blog', 'namespace' => 'Admin\Blog'], function () {
            Route::get('/', [
                'as' => 'category-blog.index',
                'uses' => 'CategoryBlogController@index',
//            'middleware' => 'permission:user-list'
            ]);

            //create cate blog
            Route::post('/create', [
                'as' => 'category-blog.store',
                'uses' => 'CategoryBlogController@store',
//            'middleware' => 'permission:user-create'
            ]);
            Route::get('/create', [
                'as' => 'category-blogs.create',
                'uses' => 'CategoryBlogController@create',
//            'middleware' => 'permission:user-create'
            ]);

            //update cate blog
            Route::get('/edit/{id}', [
                'as' => 'category-blog.edit',
                'uses' => 'CategoryBlogController@edit',
//            'middleware' => 'permission:user-edit'
            ]);
            Route::post('/edit/{id}', [
                'as' => 'category-blog.update',
                'uses' => 'CategoryBlogController@update',
//            'middleware' => 'permission:user-edit'
            ]);

            //delete cate blog
            Route::delete('/delete/{id}', [
                'as' => 'category-blog.delete',
                'uses' => 'CategoryBlogController@destroy',
//            'middleware' => 'permission:user-delete'
            ]);
            //LIST
            Route::get('/list', 'CategoryBlogController@getList')
                ->name('category-blog.list');
        });

        //BLOG
        Route::group(['prefix' => 'blog', 'namespace' => 'Admin\Blog'], function () {
            Route::get('/', [
                'as' => 'blog.index',
                'uses' => 'BlogController@index',
//            'middleware' => 'permission:user-list'
            ]);

            //create  blog
            Route::post('/create', [
                'as' => 'blog.store',
                'uses' => 'BlogController@store',
//            'middleware' => 'permission:user-create'
            ]);
            Route::get('/create', [
                'as' => 'blog.create',
                'uses' => 'BlogController@create',
//            'middleware' => 'permission:user-create'
            ]);

            //update blog
            Route::get('/edit/{id}', [
                'as' => 'blog.edit',
                'uses' => 'BlogController@edit',
//            'middleware' => 'permission:user-edit'
            ]);
            Route::post('/edit/{id}', [
                'as' => 'blog.update',
                'uses' => 'BlogController@update',
//            'middleware' => 'permission:user-edit'
            ]);

            //delete blog
            Route::delete('/delete/{id}', [
                'as' => 'blog.delete',
                'uses' => 'BlogController@destroy',
//            'middleware' => 'permission:user-delete'
            ]);

            //list
            Route::get('/list', 'BlogController@getList')
                ->name('blog.list');
        });

        Route::group(['prefix' => 'blogs', 'namespace' => 'Admin\Blog'], function () {
            Route::get('index', 'BlogController@index')->name('blog.index');
            Route::post('store', 'BlogController@store')->name('blog.store');
            Route::get('show/{id}', 'BlogController@show')->name('blog.show');
            Route::post('update/{id}', 'BlogController@update')->name('blog.update');
            Route::get('destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
        });

        Route::group(['prefix' => 'member', 'namespace' => 'Admin\Member'], function () {
            Route::get('index', 'MemberControler@index')->name('member.index');
            Route::get('/member-edit/{id}', 'MemberControler@edit')->name('member.edit');
            Route::get('/member-edit', 'MemberControler@edit')->name('member.edit');
            Route::post('/member-update', 'MemberControler@update')->name('member.update');
            Route::get('member/destroy', 'MemberControler@destroy')->name('member.destroy');
        });

        Route::group(['prefix' => 'staff', 'namespace' => 'Admin\Staff'], function () {
            Route::get('index', 'StaffControler@index')->name('staff.index');
            Route::get('/staff-edit/{id}', 'StaffControler@edit')->name('staff.edit');
            Route::get('/staff-edit', 'StaffControler@edit')->name('staff.edit');
            Route::post('/staff-update', 'StaffControler@update')->name('staff.update');
            Route::get('/staff/destroy', 'StaffControler@destroy')->name('staff.destroy');
            Route::get('/view-add-staff', 'StaffControler@viewAddNew')->name('staff.view.add');
            Route::post('/staff-store', 'StaffControler@store')->name('staff.store');
        });

        Route::group(['prefix' => 'config-home', 'namespace' => 'Admin\ConfigHome'], function () {
            Route::get('edit', 'ConfigHomeController@edit')->name('confighome.edit');
            Route::post('/update', 'ConfigHomeController@update')->name('home.update');
        });

        //* Manage cart
        Route::get('manage-cart', 'Admin\ManageCart\ManageCartController@index')->name('manage.cart.index');
        Route::get('load-cart', 'Admin\ManageCart\ManageCartController@edit')->name('manage-cart.edit');
        Route::get('detete-cart', 'Admin\ManageCart\ManageCartController@delete')->name('manage-cart.delete');
        Route::get('update-cart', 'Admin\ManageCart\ManageCartController@update')->name('manage-cart.update');

        //* Discount code
        Route::group(['prefix' => 'discount-code'], function () {
            Route::get('/view-discount', 'Admin\DiscountCode\DiscountCodeController@index')->name('discount.index');
            Route::get('/add-discount', 'Admin\DiscountCode\DiscountCodeController@viewAdd')->name('discount.add');
            Route::post('/insert-code', 'Admin\DiscountCode\DiscountCodeController@insertCode')->name('insert-code');
            Route::get('/show-code', 'Admin\DiscountCode\DiscountCodeController@showCode')->name('show.code');
            Route::post('/update-code', 'Admin\DiscountCode\DiscountCodeController@updateCode')->name('update.code');
            Route::post('/view-delete', 'Admin\DiscountCode\DiscountCodeController@delete')->name('discount.delete');
        });

        //* Discount-code
        Route::group(['prefix' => 'affiliate'], function () {
            //* Commission Rate
            Route::get('commission-rate', 'Admin\Affiliate\CommissionRateController@index')->name('rose.index');
            Route::post('commission-rate-insert', 'Admin\Affiliate\CommissionRateController@insert')->name('rose.insert');
            Route::get('commission-rate-delete', 'Admin\Affiliate\CommissionRateController@delete')->name('rose.delete');
            Route::get('commission-rate-edit', 'Admin\Affiliate\CommissionRateController@edit')->name('rose.edit');
            Route::post('commission-rate-update', 'Admin\Affiliate\CommissionRateController@update')->name('rose.update');

            //* Affiliate Partner
            Route::get('partner-view', 'Admin\Affiliate\PartnerController@index')->name('partner.index');
            Route::get('partner-delete', 'Admin\Affiliate\PartnerController@delete')->name('partner.delete');
            Route::get('partner-edit', 'Admin\Affiliate\PartnerController@edit')->name('partner.edit');
            Route::post('partner-approve', 'Admin\Affiliate\PartnerController@approve')->name('partner.approve');
            Route::post('partner-lockup', 'Admin\Affiliate\PartnerController@lockup')->name('partner.lockup');
            Route::post('partner-unlockup', 'Admin\Affiliate\PartnerController@unlockup')->name('partner.unlockup');

            //* Program Affiliate
            Route::get('program-view', 'Admin\Affiliate\ProgramSellController@index')->name('program.index');
            Route::get('program-view-category', 'Admin\Affiliate\ProgramSellController@view')->name('program.view');
            Route::get('program-view-add', 'Admin\Affiliate\ProgramSellController@viewAdd')->name('program.add');
            Route::post('program-view-insert', 'Admin\Affiliate\ProgramSellController@insert')->name('program.insert');
            Route::get('program-view-delete', 'Admin\Affiliate\ProgramSellController@delete')->name('program.delete');
            Route::get('program-view-edit', 'Admin\Affiliate\ProgramSellController@edit')->name('program.edit');
            Route::post('program-view-update', 'Admin\Affiliate\ProgramSellController@update')->name('program.update');
        });

        
        Route::post('/product-export-excel', 'Admin\ExcelProduct\ExcelProductController@export')->name('product.export.excel');
        
    });
});



//* Route - User
Route::group(['prefix' => ''], function () {
    Route::get('/', 'User\Home\HomeController@index')->name('index');
    Route::resource('/men', 'User\Product\ProductMenController');
    Route::resource('/women', 'User\Product\ProductWomenController');

    Route::get('/load-product', 'User\Product\ProductController@loadProduct')->name('load.product');
    Route::get('/load-category', 'User\Product\ProductController@loadCategory')->name('load.category');
    Route::get('/load-brand', 'User\Product\ProductController@loadBrand')->name('load.brand');

    //* live search data
    Route::get('/live-search', 'User\Product\ProductController@liveSearch')->name('live_search.action');

    Route::get('/load-comment', 'User\Product\ProductController@loadComment')->name('load.comment');
    Route::post('/add-comment', 'User\Product\ProductController@addComment')->name('add.comment');
    Route::post('/reply-comment', 'User\Product\ProductController@replyComment')->name('reply.comment');
    Route::post('/edit-comment', 'User\Product\ProductController@editComment')->name('edit.comment');
    Route::post('/update-comment', 'User\Product\ProductController@updateComment')->name('update.comment');
    Route::post('/delete-comment', 'User\Product\ProductController@deleteComment')->name('delete.comment');

    Route::resource('/cart', 'User\Cart\CartController')->except(['']);
    Route::get('/discount', 'User\Cart\CartController@checkDiscount')->name('discount.product');

    Route::get('/checkout', 'User\Cart\CheckoutController@index')->name('checkout.index');
    Route::get('/checkout/vnpay', 'User\Cart\CheckoutController@checkoutVnpay')->name('checkout.vnpay');
    Route::post('/checkout/store', 'User\Cart\CheckoutController@store')->name('checkout.store');
    Route::post('/checkout/payment', 'User\Cart\CheckoutController@createPayment')->name('checkout.payment');
    Route::get('/payment/vnpay', 'User\Cart\CheckoutController@vnpayReturn')->name('vnpay.return');

    Route::get('/login', 'User\Account\AccountController@view_login')->name('login-view');
    Route::get('/register', 'User\Account\AccountController@view_register')->name('register-view');
    Route::post('/register/check', 'User\Account\AccountController@register')->name('register');
    Route::post('/login/check', 'User\Account\AccountController@login')->name('login');
    Route::get('/logout', 'User\Account\AccountController@logout')->name('logout');

    //* information account
    Route::get('/information', 'User\Account\AccountController@information')->name('information');
    Route::get('/load-information', 'User\Account\AccountController@loadInformation')->name('load.information');
    Route::get('/data-information', 'User\Account\AccountController@dataInformation')->name('data.information');
    Route::get('/load-manage-order', 'User\Account\AccountController@loadManageOrder')->name('load.manage-order');
    Route::get('/data-manage-order', 'User\Account\AccountController@dataManageOrder')->name('data.manage.order');
    Route::get('/detail-order', 'User\Account\AccountController@detailOrder')->name('detail.order');
    Route::get('/cancel-order', 'User\Account\AccountController@cancelOrder')->name('cancel.order');

    Route::post('/upload-avatar', 'User\Account\AccountController@uploadAvatar')->name('upload.avatar');
    Route::post('/change-pass', 'User\Account\AccountController@changePass')->name('account.changepass');
    Route::post('/update-information', 'User\Account\AccountController@updateInformation')->name('update.information');


    //* to mix fashion
    Route::group(['prefix' => 'mix-fashion'], function () {
        Route::get('/', 'User\MixFashion\MixFashionController@index')->name('fashion.directional');
        Route::get('mix-fashion/{id}', 'User\MixFashion\MixFashionController@directional')->name('fashion.mix');
        Route::get('/men', 'User\MixFashion\MixFashionController@menIndex')->name('fashion.men');
        Route::get('/women', 'User\MixFashion\MixFashionController@womenIndex')->name('fashion.women');

        Route::get('/loadCategory', 'User\MixFashion\MixFashionController@loadCategory')->name('fashion.loadCategory');
        Route::get('/loadProduct', 'User\MixFashion\MixFashionController@loadProduct')->name('fashion.loadProduct');
        Route::get('/detail-product', 'User\MixFashion\MixFashionController@detailProduct')->name('fashion.detailProduct');

        Route::get('/add-suit', 'User\MixFashion\MixFashionController@addSuit')->name('fashion.addSuit');
        Route::get('/load-suit', 'User\MixFashion\MixFashionController@loadSuit')->name('fashion.loadSuit');
        Route::get('/add-suit-cart', 'User\MixFashion\MixFashionController@addSuitCart')->name('fashion.addSuitCart');
    });

    //* Affiliate
    Route::group(['prefix' => 'index-affiliate'], function () {
        Route::get('/', 'User\Affiliate\AffiliateController@index')->name('affiliate.index');

        Route::get('/introduce-affiliate', 'User\Affiliate\AffiliateController@introduce')->name('affiliate.introduce');
        Route::get('/directional-affiliate', 'User\Affiliate\AffiliateController@directional')->name('affiliate.directional');
        Route::get('/register-affiliate', 'User\Affiliate\AffiliateController@register')->name('affiliate.register');
        Route::get('/login-affiliate', 'User\Affiliate\AffiliateController@login')->name('affiliate.login');

        Route::get('/manage-program', 'User\Affiliate\AffiliateController@manageProgram')->name('affiliate.manage');
        Route::get('/profile-account', 'User\Affiliate\AffiliateController@profileAccount')->name('affiliate.profile');
        Route::post('/update-account', 'User\Affiliate\AffiliateController@updateAffiliate')->name('update.profile');
        Route::post('/change-password-account', 'User\Affiliate\AffiliateController@changePassword')->name('affiliate.changepass');

        Route::post('/view-qrcode', 'User\Affiliate\AffiliateController@getLinkQr')->name('view.linkqr');

        Route::get('/program-detail', 'User\Affiliate\AffiliateController@showProgram')->name('program.detail');
        Route::post('/register-program', 'User\Affiliate\AffiliateController@registerProgram')->name('program.register');

        Route::get('/manage-revenue', 'User\Affiliate\AffiliateController@manageRevenue')->name('manage.revenue');
        Route::get('/load-detail-table', 'User\Affiliate\AffiliateController@loadDetailTabel')->name('detail.data');

        Route::post('/affiliate-register', 'User\Affiliate\PartnerController@register')->name('partner.register');
        Route::post('/affiliate-login', 'User\Affiliate\PartnerController@login')->name('partner.login');
        Route::get('/affiliate-logout', 'User\Affiliate\PartnerController@logout')->name('partner.logout');
    });

    //* link code affiliate
    Route::get('/affiliate/{partner}/{program}/{sca_key}','User\Affiliate\AffiliateController@getLink')->name('affiliate.link');

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'User\Blog\UserBlogController@index')->name('blog.user.index');
        Route::get('/{id}', 'User\Blog\UserBlogController@show')->name('blog.user.show');
    });
});
