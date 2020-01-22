<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KyoController extends Controller
{

	public function test(Request $request)
	{
		return 'kyo/test';

		/* 設置 Session data FROM A
		$session = $request->session();
		$session->put('user', [
			'name' => 'Kyo',
			'age' => rand(26, 30),
			'date' => date('Y-m-d H:i:s'),
		]);
		return response()->json([
			'session_id' => $session->getId(),
			'user' => $session->get('user'),
		]);
		*/

		/* 取得 Session data FROM B
		$session_id = 'Vk4qNflP069euaTzEXMV13UZKH5hWM3Vq0faE44s';
		$session = $request->session();
		$session->setId($session_id);
		return response()->json([
			'session_id' => $session->getId(),
			'user' => $session->get('user'),
		]);
		*/
	}

	// Cross-origin resource sharing
	public function cors(Request $request)
	{
		return response()
			->json([
				'method' => $request->method(),
				'name' => 'Kyo ' . rand(1, 3),
				'age' => rand(18, 30),
				'client_msg' => $request->input('client_msg'),
			])->header('Access-Control-Allow-Origin', '*');
	}

	public function jsonp(Request $request)
	{
		return response()
			->json([
				'method' => $request->method(),
				'name' => 'Kyo ' . rand(1, 3),
				'age' => rand(18, 30),
				'client_msg' => $request->input('client_msg'),
			])
			->withCallback($request->input('callback'));
	}

	public function session(Request $request)
	{
		$session = $request->session();

		$client_msg = $request->input('client_msg');
		if ($client_msg) {
			$session->put('client', [
				'time' => date('Y-m-d H:i:s'),
				'msg' => $client_msg,
			]);
		}

		$res = response()->json([
			'action' => $client_msg ? 'Set session' : 'Get session',
			'data' => $client_msg ? '' : $session->get('client'),
			'session_id' => $session->getId(),
			'all' => $session->all(),
		]);

		$allowed_origins = [
			'http://img.smoking.gov:10080',
		];
		if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
			$res
				/*
					簡單跨域請求 (允許的來源)

					When request's credentials mode is 'include', 該值就不能設為 '*'
				*/
				->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'])
				/* 指定允許的 HTTP methods (簡單請求僅允許 GET, HEAD, POST)
				->header('Access-Control-Allow-Methods', 'DELETE, OPTIONS, PUT')
				*/
				/* 指定允許的 Headers (有自訂的表頭需設定)
				->header('Access-Control-Allow-Headers', 'X-Custom-Header')
				*/
				/*
					身分驗證請求 (允許來源傳送子網域的 cookies, 前端需要配合調整, 參考: https://developer.mozilla.org/zh-TW/docs/Web/API/XMLHttpRequest/withCredentials)

					例: $.ajax({xhrFields: {withCredentials: true}});
				*/
				->header('Access-Control-Allow-Credentials', 'true');
		}

		return $res;
	}

}
