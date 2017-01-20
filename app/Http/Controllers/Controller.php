<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Redis;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    
    public $user;
    public $redis;
    public $title;
	
    public function __construct()
    {
		$this->middleware(function ($request, $next) {
			$this->setTitle('Title not stated');
			if(Auth::check()) {
				$this->user = Auth::user();
				view()->share('u', $this->user);
			}
			$this->redis = Redis::connection();
			return $next($request);
		});
    }
	
    public function  __destruct()
    {
        //$this->redis->disconnect();
    }

    public function setTitle($title)
    {
        $this->title = $title;
        view()->share('title', $this->title);
    }
}
