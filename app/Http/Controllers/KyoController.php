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

	// CORS 簡單請求
	public function corsSimple(Request $request)
	{
		// 將跨來源設定寫在 apache 或 nginx
		return response()
			->json([
				'method' => $request->method(),
				'name' => 'Kyo ' . rand(1, 3),
				'age' => rand(18, 30),
				'client_msg' => $request->input('client_msg'),
			]);
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

		$allowed_origin_pattern = '/\.(smoking\.gov|i7di\.local)$/';
		if (isset($_SERVER['HTTP_ORIGIN']) && preg_match($allowed_origin_pattern, $_SERVER['HTTP_ORIGIN'])) {
			$res
				/*
					允許跨來源請求 (Cross-origin)

						若 client 要傳送包含身份驗證的請求，Access-Control-Allow-Origin 就不能設為 '*'，必須是明確的值
						也必須回應 Access-Control-Allow-Credentials: true 標頭
						Cookie 的 SameSite 屬性要設為 none，還要有 Secure 屬性 (僅透過 https 傳送)
				*/
				->header('Access-Control-Allow-Origin', $_SERVER['HTTP_ORIGIN'])
				/*
					包含身分驗證的請求 (允許 client 傳送 cookie 或 HTTP Authentication，前端需要配合調整
						例: $.ajax({xhrFields: {withCredentials: true}});

					參考: https://developer.mozilla.org/zh-TW/docs/Web/API/XMLHttpRequest/withCredentials)
				*/
				->header('Access-Control-Allow-Credentials', 'true');
				/* 指定允許的 HTTP methods (簡單請求僅允許 GET, HEAD, POST)
				->header('Access-Control-Allow-Methods', 'DELETE, OPTIONS, PUT')
				*/
				/* 指定允許的 Headers (有自訂的表頭需設定)
				->header('Access-Control-Allow-Headers', 'X-Custom-Header')
				*/
		}

		return $res;
	}

	// Session 簡單請求
	public function sessionSimple(Request $request)
	{
		$session = $request->session();

		$client_msg = $request->input('client_msg');
		if ($client_msg) {
			$session->put('client', [
				'time' => date('Y-m-d H:i:s'),
				'msg' => $client_msg,
			]);
		}

		// 將跨來源設定寫在 apache 或 nginx
		return response()->json([
			'action' => $client_msg ? 'Set session' : 'Get session',
			'data' => $client_msg ? '' : $session->get('client'),
			'session_id' => $session->getId(),
			'all' => $session->all(),
		]);
	}

}
