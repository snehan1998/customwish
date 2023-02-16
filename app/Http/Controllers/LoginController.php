<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->redirectTo = url()->previous();
    }

        public function showLoginForm()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->where('status','Active')->first();
        if (!empty($user))
        {
            if(Auth::attempt([
                'email' =>$request->email,
                'password' =>$request->password
            ])){
                if($user->role_id == 1)
                {
                    return redirect('admin/dashboard');
                }else{
                    return redirect('user/dashboard');
                }
            }
            return redirect('/login')->with('flash_error','Username/Password is wrong!!!!');

      }else{

              return redirect('/login')->with('flash_error', 'Your Account is not Activated !!!');
      }

    }

}