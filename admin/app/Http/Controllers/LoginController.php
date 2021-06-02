<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if($username !='' && !empty($username) && $password !='' && !empty($password))
        {
        	$data       = LoginModel::select('*')->where('Email',$username)->Where('Password',$password)->where('Status',1)->get();
	        $size       = count($data);
	        if($size>0)
	        {
                $da         = json_decode($data,true);
                session()->put('Admin_Name',$da[0]['Name']);
                session()->put('Admin_Id',$da[0]['Admin_Id']);
                return view('home');
	        }else{
	        	return redirect('/')->with('msg','Please Enter Valid Credentials!');
	        }
        }else{
            return redirect('/')->with('msg','Username or Password Empty!');
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
