<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{

    public function index(){
        $users = User::all();
        return view('admin.dashboard')->with('users',$users);
    }

    public function register(){
        $users = User::all();
        return view('admin.register')->with('users', $users);
    } 

    public function registeredit(Request $request , $id){
        $users = User::findorfail($id);
        return view('admin.register-edit')->with('users', $users);
    }

    public function registerupdate(Request $request , $id){
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->status = $request->input('status');
        $users->update();

        return redirect('/registerrole')->with('status', 'User Data is Updated Successfully');
    }

    public function registerdelete(Request $request , $id){
        $users = User::findorfail($id);
        $users->status = 'disabled';
        $users->update();

        return redirect('/registerrole')->with('status','User Data is Deleted Successfully');
    }
}
