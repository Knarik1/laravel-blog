<?php






Route::auth();

Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'posts'],function(){
    Route::get('create/{id}','HomeController@create') -> name('create');
    Route::post('store', 'HomeController@store');


});


Route::resource('user','UserController');










