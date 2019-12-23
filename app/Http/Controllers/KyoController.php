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
	}

}
