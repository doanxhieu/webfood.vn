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

// ===========Route Index================
Route::get('chatbox','ChatBoxController@chat')->name('chatbox');
Route::post('/comment', function (Illuminate\Http\Request $request) {
    event(new App\Events\ChatEvent($request->get('message')));
    return [
        'status' => true,
    ];
})->name('chat');


Route::get('', [
    'as' => 'frontend.index',
    'uses' => 'Frontend\PageController@index'
]);
Route::get('vuejs',function(){
    return view('vuejs');
});
Route::group(['prefix'=>'product'], function(){
    Route::get('','Frontend\PageController@getProduct')->name('frontend.product.index');
    Route::get('all/{cate?}','Frontend\PageController@getProduct')->name('frontend.product.cate');
    Route::get('{slug}','Frontend\PageController@getProductDetail')->name('frontend.product.detail');
});

Route::get('lien-he', [ 
    'as' => 'lien-he', 
    'uses' => 'Frontend\PageController@getContact'
]);
Route::post('sendcontact','Frontend\PageController@sendContact')->name('post-lienhe');

Route::get('gioi-thieu', [
    'as' => 'gioi-thieu',
    'uses' => 'Frontend\PageController@getAbout'
]);
Route::get('mailcart','Frontend\PageController@sendcart')->name('sendcart');
// LOGIN
Route::get('dang-xuat',['as'=>'dang-xuat','uses'=>'Frontend\LoginController@getLogout']);
Route::get('login',['as'=>'dang-nhap','uses'=>'Frontend\LoginController@getLogin']);
Route::post('post-login',['as'=>'postlogin','uses'=>'Frontend\LoginController@postLogin']);
Route::post('login/resetpassword','Frontend\LoginController@resetpassword');
// register
Route::get('register',['as' => 'register', 'uses' => 'Frontend\LoginController@registerAction']); 
Route::post('postRegister',['as' => 'postregister', 'uses' =>'Frontend\LoginController@registerUser']);
// Cart
Route::prefix('cart')->group(function(){
    Route::get('count',['as'=>'cart.count', 'uses'=>'Frontend\CartController@count']);
    Route::post('destroy',['as'=>'cart.destroy','uses'=>'Frontend\CartController@destroy']);
    Route::post('add-to-list',['as'=>'cart.add', 'uses' => 'Frontend\CartController@addCart']);
    Route::get('xem-gio-hang',['as'=>'cart.view','uses'=>'Frontend\CartController@viewCart']);
    Route::post('update',['as'=>'cart.update', 'uses'=>'Frontend\CartController@updateCart']);
    Route::post('storecart',['as'=>'cart.storecart','uses'=>'Frontend\CartController@saveCartDB']);
    Route::post('test',['as'=>'cart.test','uses'=>'Frontend\CartController@test']);
    Route::post('insertCartDetail',['as'=>'cart.insertCartDetail','uses'=>'Frontend\CartController@insertCartDetail']);
    Route::get('view-ordered','Frontend\CartController@viewOrdered')->name('cart.viewordered')->middleware('checklogin.client');
});

// ADDRESS
Route::post('quanhuyen',['as'=>'quanhuyen','uses'=>'Frontend\CartController@getquanhuyen']);
Route::post('xaphuong',['as'=>'xaphuong','uses'=>'Frontend\CartController@getxa']);

// ===========Route ADMIN================
Route::group(['prefix' => 'admin'], function () {
    // LOGIN ADMIN
    Route::patch('/settings', 'AdminController@patch');
    Route::get('login', ['as' => 'admin.login', 'uses' => 'Admin\LoginController@index']);
    Route::post('postlogin', ['as' => 'admin.postlogin', 'uses' => 'Admin\LoginController@postLoginAction']);
    Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Admin\LoginController@logoutAction']);
    // LOGIN API F, G
    Route::get('login/{provider}', 'Admin\LoginController@redirectToProvider')->name('login.provider');
    Route::get('login/{provider}/callback',
        'Admin\LoginController@handleProviderCallback')->name('login.provider.callback');

    Route::middleware(['sentinel.login'])->group(function () {
        // Dashboard
        Route::get('/', 'Admin\AdminController@getIndex')->name('admin.index');
        Route::get('calendar', 'Admin\AdminController@calendar')->name('google.calendar');

        Route::group([
            'prefix'     => 'user',
            'middleware' => ['inrole'],
            'inrole'     => ['admin' => true, 'employee' => true]
        ], function () {
            Route::get('/', 'Admin\UserController@index')->name('admin.user.view');
            Route::get('insert','Admin\UserController@getInsert')->name('admin.user.create');
            Route::post('insert', 'Admin\UserController@saveInsertUser')->name('admin.user.saveinsert');
            Route::post('delete', 'Admin\UserController@deleteUser')->name('admin.user.delete');
            Route::post('change-role', 'Admin\UserController@changeRole')->name('admin.user.changerole');
            Route::get('profile', 'Admin\UserController@profile')->name('admin.profile.view');
            
        });
            // ROLE
        Route::group([
            'prefix'        => 'role',
            'middleware'    => ['inrole'],
            'inrole'        => ['admin' => true]
        ], function(){
            Route::get('/', 'Admin\RoleController@getListRole')->name('admin.role.view');
            Route::post('addrole', 'Admin\RoleController@saveInsertRole')->name('admin.role.create');
            Route::post('update', 'Admin\RoleController@saveUpdatetRole')->name('admin.role.update');
            Route::post('delete', 'Admin\RoleController@deleteRole')->name('admin.role.delete');
        });
        //Category
        Route::group([
            'prefix' => 'category-manager'
        ], function () {
            Route::get('/', 'Admin\CategoryController@index')->name('admin.category.view');
            Route::get('insert', 'Admin\CategoryController@insert')->name('admin.category.insert');
            Route::post('insert', 'Admin\CategoryController@saveCate')->name('admin.category.save');
            Route::post('delete', 'Admin\CategoryController@delete')->name('admin.category.delete');
            Route::post('update', 'Admin\CategoryController@saveUpdate')->name('admin.category.update');
        });
        // Bill
        Route::group(['prefix' => 'bill-manager'], function () {
            Route::get('/{status}', 'Admin\BillController@index')->name('admin.bill.index');
            Route::post('change-status', 'Admin\BillController@saveChangeStatus')->name('admin.bill.status');
            Route::post('view-detail', 'Admin\BillController@detail')->name('admin.bill.detail');
            Route::get('print/{id}', 'Admin\BillController@print')->name('admin.bill.print');
        });
        // Product
        Route::group(['prefix' => 'product-manager'], function () {
            Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
            Route::get('insert', 'Admin\ProductController@insert')->name('admin.product.insert');
            Route::post('insert', 'Admin\ProductController@saveInsert')->name('admin.product.saveinsert');
            Route::get('update/{slug}', 'Admin\ProductController@update')->name('admin.product.update');
            Route::post('update/{id}', 'Admin\ProductController@saveupdate')->name('admin.product.saveupdate');
            Route::post('readmore', 'Admin\ProductController@readMore')->name('admin.product.readmore');
            Route::post('delete', 'Admin\ProductController@SoftDelete')->name('admin.product.delete');
        });

        Route::group(['prefix'=>'setting'], function(){
            Route::get('setting-menu','Admin\SettingController@settingMenu')->name('admin.setting.menu');
            Route::post('save','Admin\SettingController@saveMenu')->name('admin.setting.savemenu');
        });
        //error 404
        Route::any('{all?}', ['as' => 'all', 'uses' => 'Admin\AdminController@getError404'])->where('all', '(.*)');
        Route::get('404', 'Admin\AdminController@getError404')->name('admin.404');
    });
});
