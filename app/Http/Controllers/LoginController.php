<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function resendotp(Request $request)
    {
        return view('auth.resendotp');
    }

    public function verifyotp(Request $request)
    {
       return view('auth.verifyotp');
    }

    public function otpresendmail(Request $request)
    {
            $otp = $this->generateOTP();
            $user = User::where('email',$request->email)->first();
            if($user){
                $userr = User::where('email',$request->email)->update(['otp' => $otp]);
                $userrr = User::where('email',$request->email)->first();
                    $dataa = array(
                    'otp' => $userrr->otp,
                    'email' => $request->email,
                    );
                    Mail::send(['html'=>'mail.resendotpp'], $dataa, function($message) use ($dataa) {
                        $message->to($dataa['email'])->subject
                            ('Welcome To Customwish');
                        $message->from('sneha@telcopl.com','Customwish');
                    });
                    return redirect('/verifyotp');


            }else{
                return back()->with('flash_error','Email doesnot exist');
            }
    }

    public function otpverify(Request $request)
    {
        $user = User::where('otp',$request->otp)->first();
        if($user)
        {
            $userrs = User::where('id',$user->id)->update(['otp_status' => 'Active']);
            return redirect('/login');
        }else{
            return redirect('/verifyotp')->with('flash_error','OTP Entered is incorrect');
        }

    }

    public function generateOTP(){
        $otp = mt_rand(1000,9999);
        return $otp;
    }
}
