<?php

namespace Codershout\GGLink\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GGLinkAuthController extends Controller
{
    public function getLoginForm()
    {
        return view('gglink::login');
    }

    public function postLogin(Request $request)
    {
        $endPoint = config('gglink.base_url')."user/login";
        $username = $request->username;
        $password = $request->password;
        $headers = [
            'X-API-KEY' => 'AF0F56B4962DB226607A4C83F41CAF7E'
        ];
       $res = Http::withHeaders($headers)->asForm()->post($endPoint,[
           'username' => $username,
           'password' => $password,
       ]);
       $user= $res->body();
      dd($user);
        if($res->status() == 200){
            // $request->session()->put('authenticated',true);
            // $request->session()->put('user', $res->body());
            Session::put('authenticated', true);
            return redirect()->route('home');
            // return redirect()->intended('success');

        }else{
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function home()
    {
        return view('gglink::home');
    }

    public function profile()
    {

        $endPoint = config('gglink.base_url')."user/profile";
        $headers = [
            'X-API-KEY' => 'AF0F56B4962DB226607A4C83F41CAF7E',
            'x-token'   => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImlkIjoiNjMifSwiaWF0IjoxNjM1MjQzODcxLCJleHAiOjE2MzUzMzAyNzF9.T2opBXlbuATyZ_uuoU1z2YF0lryYG9NoFa2J6zl7IpM'
        ];
        $response = Http::withHeaders($headers)->get($endPoint);
        $profile = $response->Body();

        if($response){
            return view('gglink::profile',['profile' =>$profile]);
        }else{
            return redirect()->back();
        }
    }
}
