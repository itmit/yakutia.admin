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

    Route::resource('faq', 'Web\FAQWebController');
    
});

Auth::routes();
