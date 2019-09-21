<?php

Route::get('pagseguro', 'PagSeguroController@pagseguro')->name('pagseguro');
Route::get('pagseguro-lightbox', 'PagSeguroController@lightbox')->name('pagseguro.lightbox');
Route::post('pagseguro-lightbox', 'PagSeguroController@lightboxCode')->name('pagseguro.lightbox.code');

Route::get('/', function () {
    return view('welcome');
});
