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

Route::get('/', function () {
    return view('welcome');
});
//注册
Route::get('/user/register','PassPost\IndexController@register');
Route::post('/user/register','PassPost\IndexController@registerdo');

//登录
Route::get('/user/login','PassPost\IndexController@login');
Route::post('/user/login','PassPost\IndexController@logindo');



Route::get('/good/list','PassPost\IndexController@list');
Route::get('/cookie/quit','PassPost\IndexController@quit');
Route::post('/cookie/appquit','PassPost\IndexController@appquit');