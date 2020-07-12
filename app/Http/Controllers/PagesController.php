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
        $this->middleware('auth');
    }

    public function index() {
        $data = array(
            'title' => 'Dashboard',
            'fils' => File::where('parent_folder', '=', null)->get(),
            'fols' => Folder::where('parent_folder', '=', null)->get()
        );
        return view('pages.dash')->with($data);
    }
    public function create() {
        $title = 'Create';
        $fols = Folder::all();
        return view('pages.create', ['title' => $title, 'fols' => $fols]);
    }
    public function acc() {
        $title = 'Home';
        return view('pages.account')->with('title', $title);
    }
}
