<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redis;
use Auth;
use File;

class IndexController extends Controller
{
    public function __construct()
	{
		parent::__construct();
    }
    
    public function index()
    {
        return view('welcome');
    }
}