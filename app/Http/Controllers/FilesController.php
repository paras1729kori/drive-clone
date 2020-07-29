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
        $this->middleware('auth');
    }

    public function create($id) {
        return view('pages.create');
    }

    public function store(Request $request){
        //validator
        $this->validate($request, [
            'parentid' =>'nullable',
            'file' => 'required|max:1000000'  //value is in kb i.e. max limit is 1GB
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

        return redirect('/');
    }

    public function replace(Request $request){
        $ids = $request->get('ids');
        $fil = File::where('id','=',$ids)->first();
        $parent = $fil->parent_folder;
        $fol = Folder::where('id','=',$parent)->first();

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                Storage::delete('public/files/'.$filename->name);
                $filename->delete();
            }
            return view('files.replace', ['parent' => $parent,'fol' => $fol]);
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Files Selected');
            return back();
        }
    }

    //for sharing in selected folder
    public function to_folder(Request $request){
        $title = 'Move File';
        $ids_form = $request->get('ids');

        if(auth()->user()->usertype == 'admin'){
            $fols = Folder::all();
            return view('files.move', ['title' => $title, 'fols' => $fols, 'ids_form' => $ids_form]);
        }
        else{
            $fols = Folder::all()->where('id','!=',1)->where('parent_folder','!=',1);
            return view('files.move', ['title' => $title, 'fols' => $fols, 'ids_form' => $ids_form]);
        }
    }
    
    //for sharing in starred
    public function to_starred(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                $filename->starred = '1';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Files Sent to Starred');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Files Selected');
            return back();
        }
    }

    //for sharing in favs
    public function to_favs(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                $filename->favourites = '1';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Files Sent to Favourites');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Files Selected');
            return back();
        }
    }

    public function parentfiles(Request $request){
        $ids = $request->get('result');
        
        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                $filename->parent_folder =  $request->input('parentid');
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'File Moved');
            return redirect('/');
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    public function remove_fils_starred(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                $filename->starred =  '0';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'File Moved');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    public function remove_fils_favs(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                $filename->favourites =  '0';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'File Moved');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    // single file deleting
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

    //for deleting selected files
    public function deleteAll(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = File::find($id);
                Storage::delete('public/files/'.$filename->name);
                $filename->delete();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Files Deleted Successfully');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Files Selected');
            return back();
        }
    }
}