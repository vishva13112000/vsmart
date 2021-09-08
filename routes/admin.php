<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::group(['prefix' => 'shopcategory'], function () {
    Route::get('/index', 'AdminAuth\ShopCategoryController@index')->name('shopcategory.index');
    Route::get('/create', 'AdminAuth\ShopCategoryController@create')->name('shopcategory.create');
    Route::post('/store', 'AdminAuth\ShopCategoryController@store')->name('shopcategory.store');
    Route::get('/edit/{id}', 'AdminAuth\ShopCategoryController@edit')->name('shopcategory.edit');
    Route::post('/update', 'AdminAuth\ShopCategoryController@update')->name('shopcategory.update');
    Route::post('/delete', 'AdminAuth\ShopCategoryController@delete')->name('shopcategory.delete');
    Route::post('/deleteall', 'AdminAuth\ShopCategoryController@deleteall')->name('shopcategory.deleteall');
    Route::any('/unassigned', 'AdminAuth\ShopCategoryController@unassigned')->name('shopcategory.unassigned');
    Route::any('/assign', 'AdminAuth\ShopCategoryController@assign')->name('shopcategory.assign');
});


Route::group(['prefix' => 'subscription'], function () {
    Route::get('/index', 'AdminAuth\SubscriptionController@index')->name('subscription.index');
    Route::get('/create', 'AdminAuth\SubscriptionController@create')->name('subscription.create');
    Route::post('/store', 'AdminAuth\SubscriptionController@store')->name('subscription.store');
    Route::get('/edit/{id}', 'AdminAuth\SubscriptionController@edit')->name('subscription.edit');
    Route::post('/update', 'AdminAuth\SubscriptionController@update')->name('subscription.update');
    Route::post('/delete', 'AdminAuth\SubscriptionController@delete')->name('subscription.delete');
    Route::post('/deleteall', 'AdminAuth\SubscriptionController@deleteall')->name('subscription.deleteall');
    Route::any('/unassigned', 'AdminAuth\SubscriptionController@unassigned')->name('subscription.unassigned');
    Route::any('/assign', 'AdminAuth\SubscriptionController@assign')->name('subscription.assign');
});

Route::group(['prefix' => 'brands'], function () {
    Route::get('/index', 'AdminAuth\BrandsController@index')->name('brands.index');
    Route::get('/create', 'AdminAuth\BrandsController@create')->name('brands.create');
    Route::post('/store', 'AdminAuth\BrandsController@store')->name('brands.store');
    Route::get('/edit/{id}', 'AdminAuth\BrandsController@edit')->name('brands.edit');
    Route::post('/update', 'AdminAuth\BrandsController@update')->name('brands.update');
    Route::post('/delete', 'AdminAuth\BrandsController@delete')->name('brands.delete');
    Route::post('/deleteall', 'AdminAuth\BrandsController@deleteall')->name('brands.deleteall');
    Route::any('/unassigned', 'AdminAuth\BrandsController@unassigned')->name('brands.unassigned');
    Route::any('/assign', 'AdminAuth\BrandsController@assign')->name('brands.assign');
});


Route::group(['prefix' => 'category'], function () {
    Route::get('/index', 'AdminAuth\CategoryController@index')->name('category.index');
    Route::get('/create', 'AdminAuth\CategoryController@create')->name('category.create');
    Route::post('/store', 'AdminAuth\CategoryController@store')->name('category.store');
    Route::get('/edit/{id}', 'AdminAuth\CategoryController@edit')->name('category.edit');
    Route::post('/update', 'AdminAuth\CategoryController@update')->name('category.update');
    Route::post('/delete', 'AdminAuth\CategoryController@delete')->name('category.delete');
    Route::post('/deleteall', 'AdminAuth\CategoryController@deleteall')->name('category.deleteall');
    Route::any('/unassigned', 'AdminAuth\CategoryController@unassigned')->name('category.unassigned');
    Route::any('/assign', 'AdminAuth\CategoryController@assign')->name('category.assign');
});
