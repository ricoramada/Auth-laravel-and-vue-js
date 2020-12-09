<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AppController extends Controller
{
    public function init()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }

    public function login(Request $req)
    {
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password], true)) {
            return response()->json(Auth::user(), 200);
        }else {
            return response()->json(['error' => 'Akun anda tidak ada, Coba ulangi lagi'], 401);
        }
    }

    public function register(Request $req)
    {
       $user = User::where('username', $req->username)->first();

       if (isset($user->id)) {
          return response()->json(['error' => 'Username sudah ada'], 401);
       }
       $user = new User();

       $user->name = $req->name;
       $user->username = $req->username;
       $user->password = bcrypt($req->password);
       $user->save();

       Auth::login($user);

       return response()->json($user, 200);
    }

    public function logout()
    {
        Auth::logout();
    }
}
