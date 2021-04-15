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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::view('/', 'index/index');

Route::match(['post', 'delete'], '/uploading/file', 'UploadingController@file');
Route::match(['get', 'post'], '/kyo/cors', 'KyoController@cors');
Route::match(['get', 'post'], '/kyo/corsSimple', 'KyoController@corsSimple');
Route::match(['get', 'post'], '/kyo/session', 'KyoController@session');
Route::match(['get', 'post'], '/kyo/sessionSimple', 'KyoController@sessionSimple');
Route::get('/kyo/jsonp', 'KyoController@jsonp');

Route::view('/fileUploading', 'fileUploading');
Route::view('/webSocket', 'webSocket');
Route::view('/socketIo', 'socketIo');
Route::view('/socketIoV2', 'socketIoV2');
Route::view('/crossDomainRequest', 'crossDomainRequest');

/*
Route::get('/kyo/test', 'KyoController@test');
Route::post('/kyo/test', 'KyoController@test');
Route::match(['get', 'post'], '/kyo/test', 'KyoController@test');
*/
