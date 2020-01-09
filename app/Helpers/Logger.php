<?php

namespace App\Helpers;

class Logger
{

	public static function log($data, $path, $file_name = '')
	{
		if (! $file_name) {
			$caller_method = debug_backtrace()[1]['function'];
			$file_name = date('Ymd') . "-{$caller_method}.log";
		}

		$file = storage_path("logs/{$path}/{$file_name}");

		self::write($data, $file);
	}

	public static function write($data, $save_to)
	{
		$save_to_dir = pathinfo($save_to, PATHINFO_DIRNAME);
		if (! is_dir($save_to_dir)) {
			mkdir($save_to_dir, 0777, true) || die("mkdir failed. ({$save_to_dir})");
		}

		if (is_array($data) || is_object($data)) {
			$data = json_encode($data);
		}

		file_put_contents($save_to, date('H:i:s') . "\r\n" . $data . "\r\n\r\n", FILE_APPEND);
	}

}
