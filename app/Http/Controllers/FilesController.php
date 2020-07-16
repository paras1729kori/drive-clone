<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Folder;
use App\File;

class FilesController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    
    public function create($id) {
        return view('pages.create');
    }


    public function store(Request $request){
        //validator
        $this->validate($request, [
            'parentid' =>'nullable',
            'file' => 'required',
        ]);

        $filename = $request->file->getClientOriginalName();
        $filesize = $request->file->getSize();
        //Storing files in Laravel
        $request->file->storeAs('public/files', $filename);

        //Creating File
        $file = new File;
        $file->name = $filename;
        if($request->input('parentid') == 'nullable'){
            $file->parent_folder = null;
        }
        else{
            $file->parent_folder = $request->input('parentid');
        }
        $file->size = $filesize;
        $file->created_by = auth()->user()->id;  
        $file->save();

        //Flash Messages for the requests
        Session::flash('success', 'File Created Successfully');

        return back();
    }

    public function destroy($id) {
        $fil = File::find($id);
        
        //Check if post exists before deleting
        if (!isset($fil)){
            return back();
        }

        // Check for correct user
        if(auth()->user()->id !== $fil->created_by){
            //Flash Messages for the requests
            Session::flash('danger', 'Access Denied');

            return back();
        }
        
        Storage::delete('public/files/'.$fil->name);

        $fil->delete();

        //Flash Messages for the requests
        Session::flash('success', 'File Deleted Successfully');

        return back();
    }
}