<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PassReset;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ResetPass($token)
    {
        $resetpass = PassReset::where('token', '=', $token)->first();
        if ($resetpass == null)
        {
            return redirect('/login')->with('error', 'Invalid Request');
        }
        $user = User::find($resetpass->id)->first();

        return view('users.passReset', ['user'=>$user]);
    }

    public function ChangePass(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:8'
        ]);

        $user = User::find($request->user);
        $user->password = Hash::make($request->input('password'));
        $user->save();
        // $resetpass = PassReset::where('token', '=', $token)->first();
        return redirect('/login')->with('success', 'Password Changed Successfully');
    }
}
