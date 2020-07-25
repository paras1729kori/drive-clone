<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\File;
use DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['acc']]);
    }

    public function index() {
        $title = 'Dashboard';
        return view('pages.account', ['title' => $title]);
    }
    
    public function create() {
        $title = 'Create';
        $fols = Folder::all();
        return view('pages.create', ['title' => $title, 'fols' => $fols]);
    }
    public function acc() {
        $title = 'Dashboard';
        return view('pages.account')->with('title', $title);
    }

    public function download($id) {
        $download = File::find($id);
        return response()->download('storage/files/'.$download->name);
    }

    public function search(Request $request) {
        $title = 'Search Results';
        $search = $request->get('searching');
        $fils = File::where('name','like','%'.$search.'%')->get();
        $fols = Folder::where('name','like','%'.$search.'%')->get();
        return view('pages.search', ['fils' => $fils, 'fols'=>$fols, 'title'=>$title]);
    }
}
