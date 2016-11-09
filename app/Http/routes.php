<?php





Route::auth();

Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'posts'],function(){
    Route::get('create/{id}','HomeController@create') -> name('create');
    Route::post('store', 'HomeController@store');
    Route::get('show/{post_id}','HomeController@show');
    Route::delete('{post_id}','HomeController@destroy');


});

Route::resource('category', 'CategoryController');

Route::resource('post', 'PostController');

Route::resource('image', 'ImageController');

Route::resource('user', 'UserController');


Route::resource('tag', 'TagController');










