<?php

Route::get('pagseguro', 'PagSeguroController@pagseguro')->name('pagseguro');

Route::get('/', function () {
    return view('welcome');
});
