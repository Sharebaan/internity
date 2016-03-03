<?php
//Developer : serban@infora.ro

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index')->middleware('reset');
    Route::get('/platafacturi', 'FacturiController@index')->middleware('reset');
    Route::post('/platafacturi', 'FacturiController@scan');


    Route::get('/detaliifactura','FacturiController@detaliifactura')->middleware('factura');


    Route::get('/detaliiplata', 'FacturiController@detaliiplata')->middleware('plata');
    Route::post('/detaliiplata', 'FacturiController@postdetaliiplata');

    Route::get('/confirmare', 'FacturiController@confirmare')->middleware('confirmare');
    Route::get('/confirmare', 'FacturiController@postconfirmare');

    Route::get('/trimite','FacturiController@trimite');

    Route::get('/depozite', 'DepoziteController@index');

    Route::group(['middleware' => 'admin'],function(){
      Route::get('/cms/useri','CMSController@useri');
      Route::post('/cms/useri','CMSController@edituseri');
    });

});
