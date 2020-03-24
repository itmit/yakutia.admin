<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'auth.', 'middleware' => 'auth'], function () {
    
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('news', 'Web\NewsWebController');

    Route::resource('cases', 'Web\CasesWebController');

    Route::resource('polls', 'Web\PollWebController');

    Route::resource('events', 'Web\EventWebController');

    Route::resource('mods', 'Web\ModsWebController');

    Route::resource('user', 'Web\UserWebController');

    Route::resource('messenger', 'Web\MessengerWebController');

    Route::resource('documents', 'Web\DocumentWebController');
    Route::delete('documents/delete', 'Web\DocumentWebController@delete');

    Route::resource('contests', 'Web\ContestWebController');

    Route::resource('contacts', 'Web\ContactWebController');

    Route::resource('grants', 'Web\GrantWebController');

    Route::resource('faq', 'Web\FaqWebController');

    Route::resource('about', 'Web\AboutController');

    Route::get('g{t}', 'Web\MoreGrantController@index', ['t' => 1]);
    Route::get('g{t}', 'Web\MoreGrantController@index', ['t' => 2]);
    Route::get('g{t}', 'Web\MoreGrantController@index', ['t' => 3]);

    Route::post('g{t}/store', 'Web\MoreGrantController@store', ['t' => 1]);
    Route::post('g{t}/store', 'Web\MoreGrantController@store', ['t' => 2]);
    Route::post('g{t}/store', 'Web\MoreGrantController@store', ['t' => 3]);
    
    Route::post('deleteMoreGrantsFile', 'Web\MoreGrantController@deleteMoreGrantsFile');
});

Auth::routes();
