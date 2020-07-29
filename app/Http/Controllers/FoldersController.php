<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    //for showing specific files and folders in other folders (user_created)
    public function admin($id) {
        $title = Folder::find($id);
        $title = $title->name;
        $fils = File::where('parent_folder', '=', $id)->get();
        $fols = Folder::where('parent_folder', '=', $id)->get();
        return view('folders.index_admin', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for showing specific files and folders in other folders (user_created)
    public function employee($id) {
        $title = Folder::find($id);
        $title = $title->name;
        $fils = File::where('parent_folder', '=', $id)->get();
        $fols = Folder::where('parent_folder', '=', $id)->get();
        return view('folders.index_empl', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for sharing folders into a specific folder
    public function to_folder(Request $request){
        $title = 'Move Folder';
        $ids_form = $request->get('ids');
        if(auth()->user()->usertype == 'admin'){
            $fols = Folder::all();
            return view('folders.move', ['title' => $title, 'fols' => $fols, 'ids_form' => $ids_form]);
        }
        else{
            $fols = Folder::all()->where('id','!=',1)->where('parent_folder','!=',1);
            return view('folders.move', ['title' => $title, 'fols' => $fols, 'ids_form' => $ids_form]);
        }
    }

    //for sharing folders into starred
    public function to_starred(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = Folder::find($id);
                $filename->starred = '1';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Folder Sent to Starred');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    //for sharng folders into favourites
    public function to_favs(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = Folder::find($id);
                $filename->favourites = '1';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Folder Sent to Favourites');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    //for imporatant
    public function important(){
        $title = 'Important';
        $fils = File::where('parent_folder','=',1)->get();
        $fols = Folder::where('parent_folder','=',1)->get();
        return view('folders.index_admin', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }


    //for showing specific files and folders in starred
    public function starred(){
        $title = 'Starred';
        $fils = File::where('starred','=','1')->orWhere('parent_folder','=',2)->get();
        $fols = Folder::where('starred','=','1')->orWhere('parent_folder','=',2)->get();
        return view('folders.index_empl', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for showing specific files and folders in favourites
    public function favourites(){
        $title = 'Favourites';
        $fils = File::where('favourites','=','1')->orWhere('parent_folder','=',3)->get();
        $fols = Folder::where('favourites','=','1')->orWhere('parent_folder','=',3)->get();
        return view('folders.index_empl', ['title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for downloading files in folders
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
            'parentid' => 'required',
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
        
        return back();
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

    public function parentfols(Request $request){
        $ids = $request->get('result');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = Folder::find($id);
                $filename->parent_folder =  $request->input('parentid');
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Folder Moved');
            return redirect('/');
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    public function destroy($id) {
        $fol = Folder::find($id);
        $child_fols = Folder::where('parent_folder','=',$id)->count();
        $child_fils = File::where('parent_folder','=',$id)->count();

        //Check if post exists before deleting
        if (!isset($fol)){
            return back();
        }

        //Check for correct user
        if(auth()->user()->usertype != 'admin'){
            //flash message
            Session::flash('danger', 'Access Denied, Only Admins can delete folders');
            return back();
        }

        //Check if folder is empty
        if($child_fols > 0 || $child_fils > 0){
            //flash message
            Session::flash('danger', 'Folder is not empty');
            return back();
        }

        $fol->delete();

        //flash message
        Session::flash('success', 'Folder Deleted Successfully');

        return back();
    }

    public function remove_fols_starred(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = Folder::find($id);
                $filename->starred =  '0';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Folder Moved');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }

    public function remove_fols_favs(Request $request){
        $ids = $request->get('ids');

        if($ids > 0){
            foreach($ids as $id) {
                $filename = Folder::find($id);
                $filename->favourites =  '0';
                $filename->update();
            }
            //Flash Messages for the requests
            Session::flash('success', 'Folder Moved');
            return back();
        }
        else{
            //Flash Messages for the requests
            Session::flash('danger', 'No Folder Selected');
            return back();
        }
    }
}
