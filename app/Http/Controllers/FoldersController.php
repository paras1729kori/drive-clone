<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Folder;
use App\File;

class FoldersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id) {
        $title = Folder::find($id);
        $title = $title->name;
        $fils = File::where('parent_folder', '=', $id)->get();
        $fols = Folder::where('parent_folder', '=', $id)->get();
        return view('folders.index', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    public function download($id){
        $download = File::find($id);
        return response()->download('storage/files/'.$download->name);
    }

    public function create() {
        return view('pages.create');
    }

    public function store(Request $request) {
        //Validator
        $this->validate($request, [
            'name' => 'required',
            'parentid' => 'nullable',
            // 'sub' => 'required|nullable',
        ]);
        
        // Create new Folder
        $folder = new Folder;
        $folder->name = $request->input('name');
        $folder->parent_folder = $request->input('parentid');
        $folder->sub_folder = '1';
        $folder->created_by = auth()->user()->id;
        $folder->save();

        //flash message
        Session::flash('success', 'Folder Created Successully');
        
        return redirect('/home');
    }

    public function edit($id) {
        $fols = Folder::find($id);
        
        //Check if post exists before deleting
        if (!isset($fols)){
            //flash message
            Session::flash('danger', 'Folder Not Found');
            return back();
        }

        // Check for correct user
        if(auth()->user()->id !==$fols->created_by){
            //flash message
            Session::flash('danger', 'Access Denied');
            return back();
        }
        return view('folders.edit',['fols'=>$fols]);
    }

    public function update(Request $request, $id) {
        //Validator
        $this->validate($request, [
            'name' => 'required',
        ]);

        $folder = Folder::find($id);

        // Update Folder
        $folder->name = $request->input('name');
        $folder->sub_folder = '1';
        $folder->created_by = auth()->user()->id;
        $folder->save();

        //Flash Messages for the requests
        Session::flash('info', 'Changes Saved Successfully');
        
        return redirect('/home');
    }

    public function destroy($id) {
        $fol = Folder::find($id);
        
        //Check if post exists before deleting
        if (!isset($fol)){
            return back();
        }

        // Check for correct user
        // if(auth()->user()->id !==$fol->created_by){
        //     //flash message
        //     Session::flash('danger', 'Access Denied');
        //     return back();
        // }

        $fol->delete();

        //flash message
        Session::flash('success', 'Folder Deleted Successfully');

        return back();
    }
}
