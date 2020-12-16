<?php


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {
	// called while socket on connect
	$websocket->emit('message', 'Welcome ~');
	$websocket->emit('serverGotMessage', 'Server got message !!');
});

Websocket::on('disconnect', function ($websocket) {
	// called while socket on disconnect
	/* 已經斷線，所以訊息會發不出去
	$websocket->emit('message', 'Goodbye ~');
	*/
});

Websocket::on('example', function ($websocket, $data) {
	$websocket->emit('message', $data);
});


// TODO: 目前不知如何觸發此事件
Websocket::on('message', function ($websocket, $data) {
	$websocket->emit('serverGotMessage', 'Server got message !!');
});
