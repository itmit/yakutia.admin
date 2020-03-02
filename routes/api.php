<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\AuthApiController@login');
Route::post('register', 'Api\AuthApiController@register');
Route::post('logout', 'Api\AuthApiController@logout');

Route::post('sendCode', 'Api\AuthApiController@sendCode');
Route::post('resetPassword', 'Api\AuthApiController@resetPassword');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('events/getEventsByDate/{date}', 'Api\EventApiController@getEventsByDate');
    Route::post('events/registerOnEvent', 'Api\EventApiController@registerOnEvent');

    Route::get('news/index/{limit}/{offset}', 'Api\NewsApiController@index');

    Route::get('cases/index/{limit}/{offset}', 'Api\CaseApiController@index');

    Route::get('messenger/index', 'Api\MessengerApiController@index');
    Route::post('messenger/send', 'Api\MessengerApiController@send');

    Route::get('document/index', 'Api\DocumentApiController@index');

    Route::get('contests/index', 'Api\ContestApiController@index');

    Route::post('poll/getPollList', 'Api\PollApiController@getPollList');
    Route::post('poll/getPollQuestionList', 'Api\PollApiController@getPollQuestionList');
    Route::post('poll/passPoll', 'Api\PollApiController@passPoll');
    
    Route::get('contacts/index', 'Api\ContactApiController@index');

    Route::get('grants/index', 'Api\GrantApiController@index');

    Route::get('faq/index', 'Api\FaqApiController@index');

    Route::get('about', 'Api\AboutController@index');

    Route::post('moregrants', 'Api\MoreGrantController@index');
    
});


Route::get('sendPush', 'Api\EventApiController@send');
