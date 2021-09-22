<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('deliveryman')->user();

    //dd($users);

    return view('deliveryman.home');
})->name('home');

