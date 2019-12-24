<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
*/

class UploadingController extends Controller
{

	public function file(Request $request)
	{
		/* 提高上傳檔案大小限制
		ini_set('post_max_size', '128M');			// 此設定只能設定在 "PHP_INI_PERDIR" (php.ini, .htaccess, httpd.conf)
		ini_set('upload_max_filesize', '10M');		// 同上
		*/
		ini_set('max_execution_time', 300);
		ini_set('memory_limit', '256M');


		$options = [
			// 允許上傳的來源 (ex. https://www.example.com)
			'access_control_allow_origin' => env('CSR_ALLOW_ORIGIN'),
			// 接收上傳檔案的網址
			'script_url' => env('APP_URL') . '/uploading/file',
			// Server 存放檔案的路徑 (最後要加斜線)
			'upload_dir' => public_path('upload/tmp/'),
			// 前台瀏覽的網址 (最後要加斜線)
			'upload_url' => env('APP_URL') . '/upload/tmp/',
			// 允許的檔案
			'accept_file_types' => '/\.(gif|jpe?g|png|txt)$/i',
			// 上傳的圖片處理
			'image_versions' => [
				// 原始圖片
				'' => [
					// Automatically rotate images based on EXIF meta data:
					'auto_orient' => true,
				],
				/* 產生縮圖
				'thumbnail' => [
					'max_width' => 80,
					'max_height' => 80,
				]
				*/
			]
		];

		// 上傳接收器
		new \App\Plugins\UploadHandler($options);
	}

}
