<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Folder;
use App\File;
use App\User;
use DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $title = 'Dashboard';
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('pages.account',['title' => $title,'posts' => $user->posts]);
    }
    
    public function create() {
        $title = 'Create';
        $fols = Folder::all();
        return view('pages.create', ['title' => $title, 'fols' => $fols]);
    }
    public function acc() {
        $title = 'Dashboard';
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        return view('pages.account',['title' => $title,'posts' => $user->posts]);
    }

    public function download($id) {
        $download = File::find($id);
        return response()->download('storage/files/'.$download->name);
    }

    public function search(Request $request) {
        $title = 'Search Results';
        $search = $request->get('searching');
        if(isset($search)){
            if(auth()->user()->usertype == 'admin'){
                $fils = File::where('name','like','%'.$search.'%')->get();
                $fols = Folder::where('name','like','%'.$search.'%')->get();
                return view('pages.search', ['fils' => $fils, 'fols'=>$fols, 'title'=>$title]);
            }
            else{
                $fils = File::where('name','like','%'.$search.'%')->where('parent_folder','!=',1)->get();
                $fols = Folder::where('name','like','%'.$search.'%')->where('parent_folder','!=',1)->get();
                return view('pages.search', ['fils' => $fils, 'fols'=>$fols, 'title'=>$title]);
            }
        }
        else{
            //flash message
            Session::flash('danger', 'No search Input');
            return back();
        }
    }
}
