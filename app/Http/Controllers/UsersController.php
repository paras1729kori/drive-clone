<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\User;
use App\PassReset;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
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