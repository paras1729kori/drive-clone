<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $title = 'Messages';
        $users = User::all();
        $posts = Post::where('general','=','1')->get();
        if(auth()->user()->usertype != 'admin'){
            $per_posts = Post::where('reciever','=',auth()->user()->id)->orWhere('user_id','=',auth()->user()->id)->orderBy('user_id','ASC')->get();
        }
        else{
            $per_posts = Post::where('general','!=','1')->orderBy('user_id','ASC')->get(); 
        }
        return view('posts.index',['users'=>$users,'per_posts'=>$per_posts, 'posts' => $posts, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $title = 'Create Message';
        return view('posts.create', ['users'=>$users,'title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

         // Create Post
         $post = new Post;
         $post->title = $request->input('title');
         $post->body = $request->input('body');
         $post->user_id = auth()->user()->id;
         if($request->general){
            $post->general = '1';
        }
        if($request->input('reciever') == 'nullable'){
            $post->reciever = null;
        }
        else{
            $post->reciever = $request->input('reciever');
        }
        $post->save();
 
         return redirect('/posts')->with('success', 'Message Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        return "Show";
    }

    public function filter(Request $request)
    {
       $id = $request->filter_name;
       $posts = Post::where('user_id','=',$id)->orWhere('reciever','=',$id)->orderBy('updated_at', 'DESC')->get();
       return view('posts.show', ['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Message';
        $post = Post::find($id);
        
        //Check if post exists before deleting
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Messsages Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit', ['post' => $post, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);

        // Update Post
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        return redirect('/posts')->with('success', 'Message Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        //Check if post exists before deleting
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Message Found');
        }

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }

        $post->delete();
        return back()->with('success', 'Message Deleted');
    }
}
