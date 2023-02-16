<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerRegisterController extends Controller
{
    public function index()
    {
        return view('managerregister');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|unique:users|email|string',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        $checkPhone = User::where('email',$request->email)->first();

        if ($checkPhone) {
          return back()->with('flash_error', 'Manager Already exists');
        }
        else{
               $user = new User();
               $user->name = $request->name;
               $user->email = $request->email;
               $user->password = Hash::make($request->password);
               $user->role_id = '2';
               $user->save();

               $data1=new Manager();
               $data1->user_id=$user->id;
               $data1->email = $request->email;
               $data1->name = $request->name;
               $data1->password = $request->password;
               $data1->save();

/*            $users = User::find(1);
                   $details = [
                    'greeting' => 'Hi Admin',
                    'body' => 'New Manager has been registered '.$user->name,
                    'thanks' => 'Thank you for visiting ',
            ];

            $users->notify(new \App\Notifications\VendorRegister($details));

        if($data){
            $dataa = array(
            'name' =>$request->name,
            'email' =>$request->email,
            'password' => $request->password,
            'user'=>'vendor',
            );

            Mail::send(['html'=>'mail.welcome'], $dataa, function($message) use ($dataa) {
                $message->to($dataa['email'])->subject
                    ('Welcome To Powstore');
                $message->from('sneha@telcopl.com','Powstore');
            });
            $dataaa = array(
                'user'=>'admin',
                'name' =>$request->name,
                'email' =>$request->email,
                );

            Mail::send(['html'=>'mail.welcome'], $dataaa, function($message) {
                $message->to('sneha@telcopl.com')->subject
                    ('Welcome To Powstore');
                $message->from('sneha@telcopl.com','Powstore');
            });

               return redirect('managerlogin');
        }else{
            return back()->with('flash_error','Something went wrong please try again later');
        }
*/
        return redirect('managerlogin');

        }
    }
}
