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
Route::view('/fileUploading', 'fileUploading');
Route::view('/webSocket', 'webSocket');

/*
Route::get('/kyo/test', 'KyoController@test');
Route::post('/kyo/test', 'KyoController@test');
Route::match(['get', 'post'], '/kyo/test', 'KyoController@test');
*/
