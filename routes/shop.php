<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('shop')->user();

    //dd($users);

    return view('shop.home');
})->name('home');

