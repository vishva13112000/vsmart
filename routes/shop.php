<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('shop')->user();

    //dd($users);

    return view('shop.home');
})->name('shop.home');

Route::group(['prefix' => 'shop'], function () {
    Route::get('/index', 'ShopAuth\ShopController@index')->name('shop.index');
    Route::get('/create', 'ShopAuth\ShopController@create')->name('shop.create');
    Route::post('/store', 'ShopAuth\ShopController@store')->name('shop.store');
    Route::get('/edit/{id}', 'ShopAuth\ShopController@edit')->name('shop.edit');
    Route::post('/update', 'ShopAuth\ShopController@update')->name('shop.update');
    Route::post('/delete', 'ShopAuth\ShopController@delete')->name('shop.delete');
    Route::post('/deleteall', 'ShopAuth\ShopController@deleteall')->name('shop.deleteall');
    Route::any('/unassigned', 'ShopAuth\ShopController@unassigned')->name('shop.unassigned');
    Route::any('/assign', 'ShopAuth\ShopController@assign')->name('shop.assign');

});


Route::group(['prefix' => 'deliveryman'], function () {
    Route::get('/index/{id}', 'ShopAuth\DeliverymanController@index')->name('deliveryman.index');
    Route::get('/create/{id}', 'ShopAuth\DeliverymanController@create')->name('deliveryman.create');
    Route::post('/store', 'ShopAuth\DeliverymanController@store')->name('deliveryman.store');
    Route::get('/edit/{id}', 'ShopAuth\DeliverymanController@edit')->name('deliveryman.edit');
    Route::post('/update', 'ShopAuth\DeliverymanController@update')->name('deliveryman.update');
    Route::post('/delete', 'ShopAuth\DeliverymanController@delete')->name('deliveryman.delete');
    Route::post('/deleteall', 'ShopAuth\DeliverymanController@deleteall')->name('deliveryman.deleteall');
    Route::any('/unassigned', 'ShopAuth\DeliverymanController@unassigned')->name('deliveryman.unassigned');
    Route::any('/assign', 'ShopAuth\DeliverymanController@assign')->name('deliveryman.assign');

});