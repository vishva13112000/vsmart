<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('shop')->user();

    //dd($users);

    return view('shop.home');
})->name('shop.home');

Route::get('/profile', 'ShopAuth\ShopController@profile')->name('profile');
Route::post('/update', 'ShopAuth\ShopController@update')->name('update');


Route::group(['prefix' => 'deliveryman'], function () {
    Route::get('/index', 'ShopAuth\DeliverymanController@index')->name('deliveryman.index');
    Route::get('/create', 'ShopAuth\DeliverymanController@create')->name('deliveryman.create');
    Route::post('/store', 'ShopAuth\DeliverymanController@store')->name('deliveryman.store');
    Route::get('/edit/{id}', 'ShopAuth\DeliverymanController@edit')->name('deliveryman.edit');
    Route::post('/update', 'ShopAuth\DeliverymanController@update')->name('deliveryman.update');
    Route::post('/delete', 'ShopAuth\DeliverymanController@delete')->name('deliveryman.delete');
    Route::post('/deleteall', 'ShopAuth\DeliverymanController@deleteall')->name('deliveryman.deleteall');
    Route::any('/unassigned', 'ShopAuth\DeliverymanController@unassigned')->name('deliveryman.unassigned');
    Route::any('/assign', 'ShopAuth\DeliverymanController@assign')->name('deliveryman.assign');

});
