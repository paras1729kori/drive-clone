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
        $parent = $id;
        $x = 1;
        $par_fols = array();
        $id_fols =array();
        while($x != 0){
            $folder = Folder::find($id);
            $p = $folder->parent_folder;
            if($p != 0){
                array_push($par_fols, $folder->name);
                array_push($id_fols, $folder->id);
            }
            else{
                break;
            }
            $id = $p;
        }
        $parent_ids = array_reverse($id_fols);
        $parents = array_reverse($par_fols);
        $page = [];
        $page[0] = "important";
        $page[1] = "Important";
        return view('folders.important', ['page'=>$page, 'parent_ids'=>$parent_ids,'parents'=>$parents,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for showing specific files and folders in other folders (user_created)
    public function starred_folders($id) {
        $current = $id;
        $title = Folder::find($id);
        $title = $title->name;
        $fils = File::where('parent_folder', '=', $id)->get();
        $fols = Folder::where('parent_folder', '=', $id)->get();
        $x = 1;
        $par_fols = array();
        $id_fols = array();
        while($x != 0){
            $folder = Folder::find($id);
            $p = $folder->parent_folder;
            if($p != 0){
                array_push($par_fols, $folder->name);
                array_push($id_fols, $folder->id);
            }
            else{
                break;
            }
            $id = $p;
        }
        $parent_ids = array_reverse($id_fols);
        $parents = array_reverse($par_fols);
        $page = [];
        $page[0] = "starred";
        $page[1] = "Starred";
        if(auth()->user()->usertype == 'admin'){
            return view('folders.important', ['page'=>$page, 'parent_ids'=>$parent_ids,'parents'=>$parents,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
            return view('folders.starred', ['page'=>$page, 'parent_ids'=>$parent_ids,'parents'=>$parents,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }

    //for showing specific files and folders in other folders (user_created)
    public function favourites_folders($id) {
        $current = $id;
        $title = Folder::find($id);
        $title = $title->name;
        $fils = File::where('parent_folder', '=', $id)->get();
        $fols = Folder::where('parent_folder', '=', $id)->get();
        $x = 1;
        $par_fols = array();
        $id_fols =array();
        while($x != 0){
            $folder = Folder::find($id);
            $p = $folder->parent_folder;
            if($p != 0){
                array_push($par_fols, $folder->name);
                array_push($id_fols, $folder->id);
            }
            else{
                break;
            }
            $id = $p;
        }
        $parent_ids = array_reverse($id_fols);
        $parents = array_reverse($par_fols);
        $page = [];
        $page[0] = "favourites";
        $page[1] = "Favourites";
        if(auth()->user()->usertype == 'admin'){
            return view('folders.important', ['page'=>$page,'parent_ids'=>$parent_ids,'parents'=>$parents,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
            return view('folders.favs', ['page'=>$page,'parent_ids'=>$parent_ids,'parents'=>$parents,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
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
        $page = [];
        $page[0] = 'important';
        $page[1] = 'Important';
        $parents = array();
        $parent_ids = array();
        $fils = File::where('parent_folder','=',1)->get();
        $fols = Folder::where('parent_folder','=',1)->get();
        return view('folders.important', ['page'=>$page, 'parent_ids'=>$parent_ids,'parents'=>$parents,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
    }


    //for showing specific files and folders in starred
    public function starred(){
        $current = 2;
        $parents = array();
        $parent_ids = array();
        $title = 'Starred';
        $page = [];
        $page[0] = 'starred';
        $page[1] = 'Starred';
        $fils = File::where('starred','=','1')->orWhere('parent_folder','=',2)->get();
        $fols = Folder::where('starred','=','1')->orWhere('parent_folder','=',2)->get();
        if(auth()->user()->usertype == 'admin'){
            return view('folders.important', ['page'=>$page, 'parents'=>$parents,'parent_ids'=>$parent_ids,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
        else{
            return view('folders.starred', ['page'=>$page, 'parents'=>$parents,'parent_ids'=>$parent_ids,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
    }

    //for showing specific files and folders in favourites
    public function favourites(){
        $current = 3;
        $parents = array();
        $parent_ids = array();
        $title = 'Favourites';
        $page = [];
        $page[0] = 'favourites';
        $page[1] = 'Favourites';
        $fils = File::where('favourites','=','1')->orWhere('parent_folder','=',3)->get();
        $fols = Folder::where('favourites','=','1')->orWhere('parent_folder','=',3)->get();
        if(auth()->user()->usertype == 'admin'){
            return view('folders.important', ['page'=>$page,'parents'=>$parents,'parent_ids'=>$parent_ids,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
        else{
            return view('folders.favs', ['page'=>$page,'parents'=>$parents,'parent_ids'=>$parent_ids,'current'=>$current,'title' => $title, 'fils' => $fils, 'fols'=> $fols]);
        }
    }

    //for downloading files in folders
    public function download($id){
        $download = File::find($id);
        return response()->download('storage/files/'.$download->name);
    }

    //for creating files and folders in starred
    public function starred_create($id){
        $title = 'Create';
        $folder = Folder::find($id);
        $folder_id = $folder->id;
        $folder_name = $folder->name;
        // $starred = true;
        // $favourites = false;
        return view('pages.create_empl', ['title'=>$title,'folder_id'=>$folder_id,'folder_name'=>$folder_name]);
    }

    //for creating files and folders in favourites
    public function favs_create($id){
        $title = 'Create';
        $folder = Folder::find($id);
        $folder_id = $folder->id;
        $folder_name = $folder->name;
        // $starred = false;
        // $favourites = true;
        return view('pages.create_empl', ['title'=>$title,'folder_id'=>$folder_id, 'folder_name'=>$folder_name]);
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
        if($request->starred){
            $folder->starred = '1';
        }
        elseif($request->favourites){
            $folder->favourites = '1';
        }
        $folder->save();
        //flash message
        Session::flash('success', 'Folder Created Successully');
        
        if(auth()->user()->usertype == 'admin'){
            return redirect('/important');
        }
        else{
            return redirect('/starred');
        }
    }

    public function edit($id) {
        $title = 'Edit Folder';
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
        return view('folders.edit',['fols'=>$fols, 'title'=>$title]);
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
        
        if(auth()->user()->usertype == 'admin'){
            return redirect('/important');
        }
        else{
            return redirect('/starred');
        }
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
            return back();
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
