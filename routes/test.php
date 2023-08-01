<?php
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/there', function () {
    return ['Laravel' => app()->version()];
});

Route::redirect('/here', '/there');
