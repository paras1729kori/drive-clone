<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use App\PassReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //For taking inputs for Creating User
    public function registeruser(){
        return view('admin.registeruser');
    }

    //For creating/registering users
    public function registerstore(Request $request){
        //validator
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if(auth()->user()->usertype == 'admin'){
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $pass = $request->input('password');
            $user->password = Hash::make('pass');
            $user->status = 'active';
            $user->usertype = 'user';
            $user->save();

            //flash message
            Session::flash('success', 'User Created Successfully');
            return redirect('/dashboard')->with('status', 'User Created Successfully');
        }
        else{
            //flash message
            Session::flash('danger', 'Access Denied');
            return redirect('/');
        }
    }

    public function EndSession(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->logout_time = Carbon::now();
        $user->save();
        Auth::logout();
        return redirect('/login');
    }

    public function ResetPass(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);

        $email = $request->input('email');
        $user = User::where('email', '=', $email)->get()->pluck('id');

        if ($user == null)
        {
            return redirect('/resetpassword')->with('error', 'User Not Found');
        }
        else
        {
            $token = Str::random(32);
            $reset = new PassReset;
            $reset->user_id = $user[0];
            $reset->token = $token;
            $reset->save();

            return redirect("/mail/pass/$user[0]");
        }
}
}