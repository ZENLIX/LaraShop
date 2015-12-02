<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

Route::get('/', ['uses' => 'HomeController@index']);

Route::get('/test', ['uses' => 'PurchaseController@showMail']);

Route::get('/np_sync', ['uses' => 'PurchaseController@npSync']);

Route::get('/sitemap.xml', ['uses' => 'HomeController@indexSitemap']);

Route::get('/catalog', ['uses' => 'CatalogController@index']);

Route::get('/gallery', ['uses' => 'HomeController@showGallery']);

Route::get('/info', ['uses' => 'HomeController@showInfo']);

Route::get('/check', ['uses' => 'HomeController@showCheck']);

Route::get('checkQuery', function () {
    if (Input::get('code')) {
        return redirect('check/' . Input::get('code'));
    } 
    else {
        return Redirect::back();
    }
});

Route::get('/check/{id}', ['uses' => 'HomeController@showCheckByCode']);
Route::post('/comment/{id}', ['uses' => 'HomeController@storeComment']);

Route::get('/purchase', ['uses' => 'PurchaseController@index']);
Route::post('/purchase', ['uses' => 'PurchaseController@store']);

Route::get('/getUnit/{id}', ['uses' => 'PurchaseController@npGetUnit']);

Route::get('/setting/set', ['uses' => 'PurchaseController@settingSet']);
Route::get('/setting/get', ['uses' => 'PurchaseController@settingGet']);

Route::patch('basket/add/{id}', ['uses' => 'BasketController@storeProduct']);
Route::get('basket', ['uses' => 'BasketController@index']);
Route::delete('basket/empty', ['uses' => 'BasketController@destroy']);
Route::delete('basket/remove/{id}', ['uses' => 'BasketController@destroyElement']);
Route::post('basket/update/{id}', ['uses' => 'BasketController@update']);
Route::patch('basket/delivery', ['uses' => 'BasketController@updateDelivery']);
Route::patch('basket/fast', ['uses' => 'BasketController@updateFast']);
Route::patch('basket/gift', ['uses' => 'BasketController@updateGift']);

//payment/privat24
Route::any('payment/privat24', ['uses' => 'PurchaseController@showPrivat24']);
Route::any('payment/liqpay', ['uses' => 'PurchaseController@showLiqpay']);

//getUnit
//npGetCity

Route::get('/admin', function () {
    return redirect('dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('message', ['uses' => 'MessageController@index']);
    
    Route::post('message', ['uses' => 'MessageController@store']);
    
    Route::get('dashboard', ['uses' => 'DashboardController@index']);
    
    Route::get('content/cat', ['uses' => 'ContentController@indexCat']);
    Route::get('content/cat/add', ['uses' => 'ContentController@createCat']);
    Route::post('content/cat/add', ['uses' => 'ContentController@storeCat']);
    Route::patch('content/cat/sort', ['uses' => 'ContentController@sortCat']);
    Route::get('content/cat/edit/{id}', ['uses' => 'ContentController@editCat']);
    Route::patch('content/cat/edit/{id}', ['uses' => 'ContentController@updateCat']);
    Route::delete('content/cat/delete/{id}', ['uses' => 'ContentController@destroyCat']);
    Route::get('content/cat/delete', function (Request $request) {
        $request->session()->flash('alert-success', 'Категория успешно удалена!');
        return redirect('content/cat');
    });
    
    Route::get('content/prod', ['uses' => 'ContentController@indexProduct']);
    Route::get('content/product/add', ['uses' => 'ContentController@createProduct']);
    Route::post('content/product/add', ['uses' => 'ContentController@storeProduct']);
    Route::patch('content/product/sort', ['uses' => 'ContentController@sortProduct']);
    Route::get('content/product/edit/{id}', ['uses' => 'ContentController@editProduct']);
    Route::patch('content/product/edit/{id}', ['uses' => 'ContentController@updateProduct']);
    Route::delete('content/product/delete/{id}', ['uses' => 'ContentController@destroyProduct']);
    Route::get('content/product/delete', function (Request $request) {
        $request->session()->flash('alert-success', 'Продукт успешно удалён!');
        return redirect('content/prod');
    });
    Route::get('content/gallery', ['uses' => 'ContentController@indexGallery']);
    Route::patch('content/gallery/add', ['uses' => 'ContentController@storeImage']);
    Route::delete('content/gallery/delete/{id}', ['uses' => 'ContentController@destroyImage']);
    Route::patch('content/gallery/sort', ['uses' => 'ContentController@sortImage']);
    
    Route::get('content/comments', ['uses' => 'ContentController@indexComments']);
    Route::patch('content/comments/{id}', ['uses' => 'ContentController@updateCommentsApprove']);
    Route::delete('content/comments/{id}', ['uses' => 'ContentController@destroyComments']);
    
    Route::get('stat', ['uses' => 'DashboardController@showStat']);
    
    Route::get('personal', ['uses' => 'DashboardController@editPersonal']);
    Route::patch('personal', ['uses' => 'DashboardController@updatePersonal']);
    
    //updatePersonalMail
    Route::patch('personalMail', ['uses' => 'DashboardController@updatePersonalMail']);
    
    Route::get('content/info', ['uses' => 'ContentController@indexInfo']);
    
    //ContentController@updateInfo
    Route::patch('content/info/update', ['uses' => 'ContentController@updateInfo']);
    
    Route::get('money', ['uses' => 'MoneyController@index']);
    Route::patch('money', ['uses' => 'MoneyController@update']);
    
    Route::get('integration', ['uses' => 'IntegrationController@index']);
    Route::patch('integration', ['uses' => 'IntegrationController@update']);
    
    Route::get('config', ['uses' => 'ConfigController@index']);
    Route::patch('config', ['uses' => 'ConfigController@update']);
    
    Route::get('clients', ['uses' => 'ClientsController@index']);
    Route::get('clients/{id}', ['uses' => 'ClientsController@edit']);
    Route::patch('clients/{id}', ['uses' => 'ClientsController@update']);
    Route::delete('clients/{id}', ['uses' => 'ClientsController@destroy']);
    
    Route::get('orders', ['uses' => 'OrdersController@index']);
    Route::get('orders/{id}', ['uses' => 'OrdersController@show']);
    Route::get('orders/edit/{id}', ['uses' => 'OrdersController@edit']);
    Route::patch('orders/{id}', ['uses' => 'OrdersController@update']);
    Route::delete('orders/{id}', ['uses' => 'OrdersController@destroy']);
    Route::get('orders/{id}/print', ['uses' => 'OrdersController@showPrint']);
    Route::patch('orders/{id}/status/new', ['uses' => 'OrdersController@updateStatusNew']);
    Route::patch('orders/{id}/status/paid', ['uses' => 'OrdersController@updateStatusPaid']);
    Route::patch('orders/{id}/status/sent', ['uses' => 'OrdersController@updateStatusSent']);
    Route::patch('orders/{id}/ttn', ['uses' => 'OrdersController@updateTtn']);
    
    Route::patch('order/{id}/delivery', ['uses' => 'OrdersController@updateDelivery']);
    Route::get('order/{id}/cart', ['uses' => 'OrdersController@showCart']);
    
    Route::patch('order/{id}/fast', ['uses' => 'OrdersController@updateFast']);
    Route::patch('order/{id}/gift', ['uses' => 'OrdersController@updateGift']);
    Route::delete('order/{id}/remove', ['uses' => 'OrdersController@destroyElement']);
    Route::post('order/{id}/update', ['uses' => 'OrdersController@updateQty']);
    
    Route::get('order/download/{id}', ['uses' => 'OrdersController@showFile']);
    
    //storeItem
    Route::post('order/{id}/store', ['uses' => 'OrdersController@storeItem']);
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('forgot', 'Auth\PasswordController@getEmail');
Route::post('forgot', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//short link for group or user
Route::get('{id}.html', ['uses' => 'SearchController@ShortLinkHtml']);
Route::get('{id}', ['uses' => 'SearchController@ShortLinkCategory']);
