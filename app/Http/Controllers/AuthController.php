<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use DB;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller
{   
    public function login()
    {
        return Socialite::driver('steam')->redirect();
    }
    
    public function callback()
    {
        $user = json_decode(json_encode(Socialite::driver('steam')->user()));
        if(isset($user->returnUrl)) return redirect('/login');
        $user = $user->user;

        $auth = $this->find_or_create_user($user);
        Auth::login($auth, true);
        
        return redirect('/'); 
    }
    
    private function find_or_create_user($user) {
        $u = User::where('steamid64', $user->steamid)->first();
        if($u) {
            DB::table('users')->where('steamid64', $user->steamid)->update([
                'username' => $user->personaname,
                'avatar' => $user->avatarfull,
                'state' => $user->loccountrycode
            ]);
            $user = $u;
        } else {
            $user = User::create([
                'steamid64' => $user->steamid,
                'username' => $user->personaname,
                'avatar' => $user->avatarfull,
                'state' => $user->loccountrycode
            ]);
        }
        return $user;
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}