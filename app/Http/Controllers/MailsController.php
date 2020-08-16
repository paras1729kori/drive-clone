<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

use App\User;
use App\PassReset;
use App\Mail\ResetPasswordMail;

class MailsController extends Controller
{
    public function PassReset($id) 
    {
        $passreset = PassReset::where('user_id', '=', $id)->first();
        $user = User::find($id);
        $subject = "Password Reset Link Generated for Drive Account";
        $details = ['token'=>$passreset->token];
    
        \Mail::to("$user->email")->send(new ResetPasswordMail($details));
            
        // Mail::send('mail.reset', ["details" => $details], function($message) use ($user, $subject)
        // {
        //     $message->to($user->email, $user->name)->subject($subject);
        //     $message->from('noreply@jjsanganee.com', "JJ Sanganee");
        // });
        // echo "Mail Sent";
        dd("Email is Sent.");
        // return redirect("/login")->with('success', 'Mail Sent Successfully. Please check your inbox within 10 Minutes');
    }
}
