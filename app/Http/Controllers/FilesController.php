<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Folder;
use App\File;
use DB;

class FilesController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Index for pushing data specially for homepage
    public function index() {
        $title = 'Home';
        $fils = File::where('parent_folder', '=', null)->get();
        $fols = Folder::where('parent_folder', '=', null)->get();
        return view('pages.dash',['title' => $title,'fils' => $fils, 'fols' =>$fols]);
    }

    public function create($id) {
        return view('pages.create');
    }

    public function store(Request $request){
        //validator
        $this->validate($request, [
            'parentid' =>'nullable',
        ]);

        foreach ($request->file as $file) {
            $filename = $file->getClientOriginalName();
            $filesize = $file->getSize();
            //Storing files in Laravel
            $file->storeAs('public/files', $filename);

            //Creating File
            $fileModel = new File;
            $fileModel->name = $filename;
            if($request->input('parentid') == 'nullable'){
                $fileModel->parent_folder = null;
            }
            else{
                $fileModel->parent_folder = $request->input('parentid');
            }
            $fileModel->size = $filesize;
            $fileModel->created_by = auth()->user()->id;  
            $fileModel->save();
        }

        //Flash Messages for the requests
        Session::flash('success', 'File Created Successfully');

        return redirect('/home');
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

    public function deleteAll(Request $request){
        $ids = $request->get('ids');
        if($ids > 0){
            $dbs = DB::delete('delete from files where id in ('.implode(",",$ids).')');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Files Selected');
            return back();
        }
    }
}